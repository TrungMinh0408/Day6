<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: /backend/functions/user/userlist.php?deleted=1");
        exit();
    } else {
        echo "❌ Lỗi khi xóa người dùng: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Không tìm thấy ID người dùng hợp lệ.";
}

$conn->close();
?>
