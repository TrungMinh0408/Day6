<?php
function connectDb() {
    $conn = new mysqli("localhost", "root", "", "demo1");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}
?>
