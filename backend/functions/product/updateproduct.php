<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Product</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
    }
    .container {
      max-width: 700px;
      margin-top: 50px;
    }
  </style>
</head>
<body>

<div class="container bg-white shadow rounded p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary">🔄 Update Product</h2>
    <a href="productlist.php" class="btn btn-outline-secondary">← Back</a>
  </div>

  <?php
  include_once(__DIR__ . '/../../../dbConnect.php');
  $conn = connectDb();

  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $id = intval($_GET['id']);
      $sql = "SELECT * FROM products WHERE id = $id";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
  ?>

  <form action="proccessUpdateProduct.php" method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <div class="mb-3">
      <label class="form-label">Product Name</label>
      <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="3" required><?= htmlspecialchars($row['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Price</label>
      <input type="number" class="form-control" name="price" step="0.01" value="<?= htmlspecialchars($row['price']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Stock Quantity</label>
      <input type="number" class="form-control" name="stock_quantity" value="<?= htmlspecialchars($row['stock_quantity']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Image URL</label>
      <input type="text" class="form-control" name="image_url" value="<?= htmlspecialchars($row['image_url']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <input type="text" class="form-control" name="category" value="<?= htmlspecialchars($row['category']) ?>" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning">✅ Update Product</button>
    </div>
  </form>

  <?php
      } else {
          echo '<div class="alert alert-danger">❌ Không tìm thấy sản phẩm cần cập nhật.</div>';
      }
  } else {
      echo '<div class="alert alert-danger">❌ Thiếu ID sản phẩm.</div>';
  }

  $conn->close();
  ?>

</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
