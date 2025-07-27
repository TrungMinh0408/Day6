<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Product</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f8f9fa;
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
    <h2 class="text-primary">➕ Create Product</h2>
    <a href="productlist.php" class="btn btn-outline-secondary">← Back to List</a>
  </div>

  <form action="proccessCreate.php" method="post">
    <div class="mb-3">
      <label for="name" class="form-label">📦 Product Name</label>
      <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">📝 Description</label>
      <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">💵 Price</label>
      <input type="number" class="form-control" name="price" id="price" step="0.01" required>
    </div>

    <div class="mb-3">
      <label for="stock_quantity" class="form-label">📦 Stock Quantity</label>
      <input type="number" class="form-control" name="stock_quantity" id="stock_quantity" required>
    </div>

    <div class="mb-3">
      <label for="image_url" class="form-label">🖼️ Image URL</label>
      <input type="text" class="form-control" name="image_url" id="image_url">
    </div>

    <div class="mb-3">
      <label for="category" class="form-label">🏷️ Category</label>
      <input type="text" class="form-control" name="category" id="category">
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-success">✅ Create Product</button>
    </div>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
