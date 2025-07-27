<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User List</title>
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

<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

$sql = "SELECT id, username, email FROM users";

$searchEmail = '';
$searchUsername = '';
$whereAdded = false;

if (isset($_GET['btnSearch'])) {
    if (!empty($_GET['email'])) {
        $searchEmail = trim($_GET['email']);
        $escapedEmail = $conn->real_escape_string($searchEmail);
        $sql .= " WHERE email LIKE '%$escapedEmail%'";
        $whereAdded = true;
    }

    if (!empty($_GET['username'])) {
        $searchUsername = trim($_GET['username']);
        $escapedUsername = $conn->real_escape_string($searchUsername);
        if ($whereAdded) {
            $sql .= " AND username LIKE '%$escapedUsername%'";
        } else {
            $sql .= " WHERE username LIKE '%$escapedUsername%'";
        }
    }
}

$result = $conn->query($sql);
?>

<div class="container bg-white shadow rounded p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary">👥 User List</h2>
    <a href="createuser.php" class="btn btn-success" onclick="return confirm('Bạn chắc chắn muốn tạo người dùng mới?')">➕ Create New</a>
  </div>

  <form method="GET" class="row g-3 mb-4">
    <div class="col-md-10">
      <div class="input-group">
        <input type="text" class="form-control" name="email" placeholder="🔎 Tìm theo email..." value="<?= htmlspecialchars($searchEmail) ?>">
        <input type="text" class="form-control" name="username" placeholder="🔎 Tìm theo username..." value="<?= htmlspecialchars($searchUsername) ?>">
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
        <th>Username</th>
        <th>Email</th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_array(MYSQLI_NUM)): ?>
          <tr>
            <td><?= htmlspecialchars($row[0]) ?></td>
            <td><?= htmlspecialchars($row[1]) ?></td>
            <td><?= htmlspecialchars($row[2]) ?></td>
            <td><a href="updateuser.php?id=<?= $row[0] ?>" class="btn btn-warning btn-sm">✏️ Update</a></td>
            <td>
              <a href="proccessdelete.php?id=<?= $row[0] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">🗑️ Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="text-danger fw-bold">Không tìm thấy người dùng nào.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
