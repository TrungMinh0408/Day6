<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

$order_id = intval($_GET['order_id'] ?? 0);
if ($order_id <= 0) {
    echo "<div class='alert alert-danger'>Invalid Order ID</div>";
    exit;
}

$sql = "
    SELECT 
        oi.id,
        p.name AS product_name,
        p.image_url,
        oi.price_at_time,
        oi.quantity,
        (oi.price_at_time * oi.quantity) AS total_price
    FROM order_items oi
    INNER JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = $order_id
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Order Items</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f8f9fa;
    }
    .container {
      margin-top: 40px;
    }
    img.product-img {
      width: 60px;
      height: auto;
    }
  </style>
</head>
<body>

<div class="container bg-white shadow rounded p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">🧾 Order #<?= htmlspecialchars($order_id) ?> - Items</h2>
    <a href="javascript:history.back()" class="btn btn-secondary">⬅️ Back</a>
  </div>

  <table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Product</th>
        <th>Image</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><img src="/Day6/assets/<?= htmlspecialchars($row['image_url']) ?>" class="product-img" alt="Product Image"></td>
                <td><?= number_format($row['price_at_time']) ?>₫</td>
                <td><?= $row['quantity'] ?></td>
                <td><?= number_format($row['total_price']) ?>₫</td>
            </tr>
        <?php endwhile ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-danger fw-bold">No items found in this order.</td>
        </tr>
    <?php endif ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
