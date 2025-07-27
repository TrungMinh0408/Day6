<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

$productCount = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
$userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$orderCount = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];
?>
<div class="container my-4">
  <h1 class="mb-4">DASHBOARD</h1>
  <div class="row text-center">

    <div class="col-md-3 mb-3">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <h2><?= $productCount ?></h2>
          <p>Tổng số mặt hàng</p>
          <a href="/Day4/backend/pages/index.php" class="btn btn-light btn-sm mt-2">Refresh dữ liệu</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-3">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h2><?= $userCount ?></h2>
          <p>Tổng số khách hàng</p>
          <a href="/Day4/backend/pages/index.php" class="btn btn-light btn-sm mt-2">Refresh dữ liệu</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 mb-3">
      <div class="card bg-warning text-white">
        <div class="card-body">
          <h2><?= $orderCount ?></h2>
          <p>Tổng số đơn hàng</p>
          <a href="/Day4/backend/pages/index.php" class="btn btn-light btn-sm mt-2">Refresh dữ liệu</a>
        </div>
      </div>
    </div>

  </div>
</div>
