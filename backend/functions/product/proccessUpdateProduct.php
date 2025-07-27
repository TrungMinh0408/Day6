<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

if (
    isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock_quantity'], $_POST['image_url'], $_POST['category']) &&
    is_numeric($_POST['id'])
) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock_quantity = intval($_POST['stock_quantity']);
    $image_url = trim($_POST['image_url']);
    $category = trim($_POST['category']);

    // Chỉ cần 1 lần bind_param, và đúng thứ tự: ssdissi
    $stmt = $conn->prepare("UPDATE products 
                            SET name = ?, description = ?, price = ?, stock_quantity = ?, image_url = ?, category = ? 
                            WHERE id = ?");
    $stmt->bind_param("ssdissi", $name, $description, $price, $stock_quantity, $image_url, $category, $id);

    if ($stmt->execute()) {
        header("Location: productlist.php?success=1");
    } else {
        header("Location: updateproduct.php?id=$id&error=1");
    }

    $stmt->close();
} else {
    header("Location: viewproduct.php?invalid=1");
}

$conn->close();
