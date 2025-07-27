<?php
session_start();
include_once(__DIR__ . '/../../dbConnect.php');

$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? 0;
$image_url = $_POST['image_url'] ?? '';
$quantity = intval($_POST['quantity'] ?? 1); 


if (!$id || $quantity <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product or quantity']);
    exit;
}

$total = $price * $quantity;

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = [];
}

$cart[$id] = [
    'id' => $id,
    'name' => $name,
    'price' => $price,
    'quantity' => $quantity,
    'image_url' => $image_url,
    'subTotal' => $total
];

$_SESSION['cart'] = $cart;

header('Content-Type: application/json');
echo json_encode(['status' => 'success', 'cartCount' => count($cart)]);
exit;
