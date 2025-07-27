<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

if (!isset($_GET['id'])) {
    echo "Không có ID!";
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Không tìm thấy người dùng!";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <?php include_once(__DIR__ . '/../../layout/style.php'); ?>
    <meta charset="UTF-8">
    <title>Detail User</title>
</head>
<body>
  <?php include_once(__DIR__ . '/../../layout/partials/header.php'); ?>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-3">
        <?php include_once(__DIR__ . '/../../layout/partials/sitebar.php'); ?>
      </div>

      <div class="col-md-9">
        <h3 class="mb-4 text-center">Detail</h3>

        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <td><?php echo $user['id']; ?></td>
          </tr>
          <tr>
            <th>UseName</th>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
          </tr>
          <tr>
            <th>Address</th>
            <td><?php echo htmlspecialchars($user['address']); ?></td>
          </tr>
          <tr>
            <th>Create_Date</th>
            <td><?php echo $user['create_at']; ?></td>
          </tr>
        </table>

        <a href="index.php" class="btn btn-secondary">Back</a>
      </div>
    </div>
  </div>

  <?php include_once(__DIR__ . '/../../layout/partials/footer.php'); ?>
  <?php include_once(__DIR__ . '/../../layout/scripts.php'); ?>
</body>
</html>