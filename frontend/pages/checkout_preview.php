<?php
session_start();
include_once(__DIR__ . '/../../dbConnect.php');

if (!isset($_SESSION['user'])) {
    header("Location: /Day6/frontend/pages/login.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<h3>Your cart is empty!</h3>";
    exit;
}

$user_id = $_SESSION['user']['id'];
$conn = connectDb();

$result = $conn->query("SELECT address FROM users WHERE id = $user_id");
$row = $result->fetch_assoc();
$default_address = $row['address'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Order</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
<?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

<main class="container mt-5">
    <h2>Confirm Your Order</h2>

    <form action="/Day6/frontend/api/checkout.php" method="post">
        <h4>Shipping Address</h4>
        <div class="mb-3">
            <textarea name="shipping_address" class="form-control" rows="3" required><?= htmlspecialchars($default_address) ?></textarea>
        </div>

        <h4>Order Summary</h4>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; $i = 1; ?>
                <?php foreach ($cart as $item): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= number_format($item['price']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity']) ?></td>
                    </tr>
                    <?php $total += $item['price'] * $item['quantity']; ?>
                <?php endforeach ?>
                <tr>
                    <th colspan="4">Total</th>
                    <th><?= number_format($total) ?></th>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i> Confirm and Place Order
        </button>
    </form>

    <a href="/Day6/frontend/viewcart1.php" class="btn btn-secondary mt-3">
        <i class="fa fa-arrow-left"></i> Back to Cart
    </a>
</main>

<?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>
