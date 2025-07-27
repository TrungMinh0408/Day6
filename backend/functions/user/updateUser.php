<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ ID không hợp lệ.");
}

$id = intval($_GET['id']);
$sql = "SELECT id, username, email FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_array(MYSQLI_NUM);
} else {
    die("❌ Không tìm thấy người dùng.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Update User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f8f9fa;
    }
    .container {
      max-width: 600px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

<div class="container bg-white shadow rounded p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">👤 Update User</h2>
    <a href="userlist.php" class="btn btn-outline-secondary">← Back</a>
  </div>

<form action="proccessUpdate.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($row[0]) ?>">

    <div class="mb-3">
      <label for="username" class="form-label">🧑 Username</label>
      <input type="text" name="username" id="username" class="form-control" 
             value="<?= htmlspecialchars($row[1]) ?>" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">📧 Email</label>
      <input type="email" name="email" id="email" class="form-control" 
             value="<?= htmlspecialchars($row[2]) ?>" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning">✅ Update</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
