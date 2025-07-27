<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = 'user'; 

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (empty($username) || empty($email) || empty($password)) {
        $error = "Please fill in all required fields!";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username or Email already exists!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password, address, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $email, $hashed_password, $address, $role);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Register failed: " . $stmt->error;
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
  <style>
    body {
      background-color: #f5f5f5;
    }
  </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-6 bg-white p-4 rounded shadow-sm">
    <h1 class="text-center mb-4">Register</h1>

    <?php if (isset($error)) : ?>
      <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" id="username" name="username" class="form-control" required />
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" class="form-control" required />
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" id="address" name="address" class="form-control" />
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control" required />
  </div>
  <div class="mb-3">
    <label for="confirm_password" class="form-label">Confirm Password</label>
    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
  </div>
  <button type="submit" class="btn btn-primary w-100">Register</button>
</form>



    <p class="text-center mt-3">Already have an account? 
      <a href="/Day6/frontend/pages/login.php">Login</a>
    </p>
  </div>
</div>

<?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>
