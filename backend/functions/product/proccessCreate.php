<?php
include_once(__DIR__ . '/../../../dbConnect.php'); 
$conn = connectDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock_quantity = intval($_POST['stock_quantity']);
    $image_url = trim($_POST['image_url']);
    $category = trim($_POST['category']);
    $created_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO products 
        (name, description, price, stock_quantity, image_url, category, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssdisss", $name, $description, $price, $stock_quantity, $image_url, $category, $created_at);

    if ($stmt->execute()) {
        header("Location: productlist.php?success=1");
        exit();
    } else {
        header("Location: create.php?error=1");
        exit();
    }

    $stmt->close();
} else {
    echo "❌ Phương thức không hợp lệ.";
}

$conn->close();

