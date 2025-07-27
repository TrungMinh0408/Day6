<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

$order_id = intval($_POST['order_id'] ?? 0);
$new_status = $_POST['new_status'] ?? '';

$valid_statuses = ['pending', 'shipped', 'delivered'];

if ($order_id > 0 && in_array($new_status, $valid_statuses)) {
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    if ($stmt->execute()) {
        header("Location: /Day6/backend/pages/index.php?updated=1");
        exit;
    } else {
        echo "❌ Cập nhật thất bại!";
    }
} else {
    echo "⚠️ Dữ liệu không hợp lệ!";
}
