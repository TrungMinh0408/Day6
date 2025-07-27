<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product List</title>
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
    table th, table td {
      vertical-align: middle !important;
    }
    img.product-img {
      width: 80px;
      height: auto;
    }
  </style>
</head>
<body>

<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

$sql = "SELECT id, name, description, price, stock_quantity, image_url, category, created_at FROM products";

$searchName = '';
$searchCategory = '';
$whereAdded = false;

if (isset($_GET['btnSearch'])) {
    if (!empty($_GET['name'])) {
        $searchName = trim($_GET['name']);
        $escapedName = $conn->real_escape_string($searchName);
        $sql .= " WHERE name LIKE '%$escapedName%'";
        $whereAdded = true;
    }

    if (!empty($_GET['category'])) {
        $searchCategory = trim($_GET['category']);
        $escapedCategory = $conn->real_escape_string($searchCategory);
        if ($whereAdded) {
            $sql .= " AND category LIKE '%$escapedCategory%'";
        } else {
            $sql .= " WHERE category LIKE '%$escapedCategory%'";
        }
    }
}

$result = $conn->query($sql);
?>

<div class="container bg-white shadow rounded p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary">🛒 Product List</h2>
    <a href="create.php" class="btn btn-success" onclick="return confirm('Bạn chắc chắn muốn thêm sản phẩm mới?')">➕ Add Product</a>
  </div>

  <!-- 🔍 Search Form -->
  <form method="GET" class="row g-3 mb-4">
    <div class="col-md-10">
        <div class="input-group">
            <input type="text" class="form-control" name="name" placeholder="🔎 Tìm theo tên sản phẩm..." value="<?= htmlspecialchars($searchName); ?>">
            <input type="text" class="form-control" name="category" placeholder="🔎 Tìm theo danh mục..." value="<?= htmlspecialchars($searchCategory); ?>">
        </div>
    </div>
    <div class="col-md-2 d-grid">
        <button type="submit" name="btnSearch" class="btn btn-primary">Tìm kiếm</button>
    </div>
  </form>

  <table class="table table-bordered table-striped table-hover text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Mô tả</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Ảnh</th>
        <th>Danh mục</th>
        <th>Ngày tạo</th>
        <th colspan="2">Thao tác</th>
      </tr>
    </thead>
    <tbody>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars(substr($row['description'], 0, 50)) . "...</td>";
            echo "<td>" . number_format($row['price']) . "₫</td>";
            echo "<td>" . htmlspecialchars($row['stock_quantity']) . "</td>";
            echo "<td><img src='/Day4/assets/" . htmlspecialchars($row['image_url']) . "' class='product-img' alt='image'></td>";
            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
            echo "<td><a href='updateproduct.php?id={$row['id']}' class='btn btn-warning btn-sm'>✏️ Sửa</a></td>";
            echo "<td><a href='processDelete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc chắn muốn xoá sản phẩm này?')\">🗑️ Xoá</a></td>";
            echo "</tr>";
        }
    } else {
        echo '<tr><td colspan="10" class="text-danger fw-bold">Không tìm thấy sản phẩm nào.</td></tr>';
    }
    $conn->close();
    ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
