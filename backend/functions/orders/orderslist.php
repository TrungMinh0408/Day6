<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

$sql = "SELECT o.id, u.username, o.total_amount, o.status, o.order_date, o.shipping_address 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Orders List</title>
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
    table th, table td {
      vertical-align: middle !important;
    }
  </style>
</head>
<body>

<div class="container bg-white shadow rounded p-4">
  <h2 class="text-primary mb-4">📦 Danh sách đơn hàng</h2>

  <?php if (isset($_GET['updated'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      ✅ Trạng thái đơn hàng đã được cập nhật!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <table class="table table-bordered table-striped table-hover text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Khách hàng</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Ngày đặt</th>
        <th>Địa chỉ giao hàng</th>
        <th>Chi tiết</th>
        <th>Cập nhật trạng thái</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= number_format($row['total_amount']) ?>₫</td>
              <td>
                <?php
                  $statusLabel = match ($row['status']) {
                    'pending' => '<span class="badge bg-warning text-dark">Chờ xử lý</span>',
                    'shipped' => '<span class="badge bg-info text-dark">Đã giao</span>',
                    'delivered' => '<span class="badge bg-success">Đã nhận</span>',
                    default => '<span class="badge bg-secondary">Không rõ</span>',
                  };
                  echo $statusLabel;
                ?>
              </td>
              <td><?= htmlspecialchars($row['order_date']) ?></td>
              <td><?= htmlspecialchars($row['shipping_address']) ?></td>
              <td>
                <a href="/Day6/backend/functions/orders/order_itemlist.php?order_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">🔍 Xem</a>
              </td>
              <td>
                <form action="\Day6\backend\functions\orders\update_order_status.php" method="post" class="d-flex align-items-center justify-content-center">
                  <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                  <select name="new_status" class="form-select form-select-sm me-2">
                    <option value="pending" <?= $row['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="shipped" <?= $row['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                    <option value="delivered" <?= $row['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                </form>
              </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" class="text-danger fw-bold">Không có đơn hàng nào.</td>
        </tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
