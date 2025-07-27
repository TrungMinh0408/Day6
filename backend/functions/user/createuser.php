<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 600px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

<div class="container bg-white shadow rounded p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary">➕ Create New User</h2>
    <a href="userlist.php" class="btn btn-outline-secondary">← Back</a>
  </div>

  <form action="processCreate.php" method="post">
    <div class="mb-3">
      <label for="username" class="form-label">👤 Username</label>
      <input type="text" name="username" id="username" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">📧 Email</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">🔒 Password</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">🏠 Address</label>
      <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-success">✅ Create User</button>
    </div>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
