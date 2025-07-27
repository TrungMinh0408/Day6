<?php
session_start();
include_once(__DIR__ . '/../../dbConnect.php');

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die('Cart is empty');
}

if (!isset($_SESSION['user'])) {
    die('User not logged in');
}

$cart = $_SESSION['cart'];
$user_id = $_SESSION['user']['id'];

$total_amount = 0;
foreach ($cart as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

$shipping_address = $_POST['shipping_address'] ?? '';
if (empty($shipping_address)) {
    die("Shipping address is required");
}
$conn = connectDb();
$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, shipping_address) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $user_id, $total_amount, $shipping_address);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_time) VALUES (?, ?, ?, ?)");
    foreach ($cart as $item) {
        $order_id_int = (int)$order_id;
        $product_id = (int)$item['id'];
        $quantity = (int)$item['quantity'];
        $price = (float)$item['price'];
        $stmt->bind_param("iiid", $order_id_int, $product_id, $quantity, $price);
        $stmt->execute();
    }
    $stmt->close();

    unset($_SESSION['cart']);

    $conn->commit();
    $_SESSION['order_just_placed'] = true;
    header("Location: /Day6/frontend/pages/checkout_success.php");
    exit;
} catch (Exception $e) {
    $conn->rollback();
    echo "Checkout failed: " . $e->getMessage();
}
?>
