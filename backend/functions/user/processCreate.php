<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $address = trim($_POST['address']);
    $create_at = date('Y-m-d H:i:s');

    // Hash mật khẩu trước khi lưu
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Chuẩn bị câu lệnh SQL
    $sql = "INSERT INTO users (username, email, password, address, created_at)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $username, $email, $hashedPassword, $address, $create_at);

    // Thực thi
    if ($stmt->execute()) {
        header("Location: userlist.php?created=1");
        exit();
    } else {
        echo "❌ Lỗi khi thêm người dùng: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "❌ Phương thức gửi dữ liệu không hợp lệ.";
}

$conn->close();
