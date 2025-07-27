<?php
session_start();

include_once(__DIR__ . '/../../dbConnect.php');

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image_url = $_POST['image_url'];
// $quantity = $_POST['quantity'];
$quantity = 1;
$_SESSION['quantity'] = $quantity;
$total = $price * $quantity;

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    $cart[$id] = [
        'id'=>$id,
        'name'=>$name,
        'price'=>$price,
        'quantity'=>$quantity,
        'image_url'=>$image_url,
        'subTotal'=>$total
    ];
}else{
    $cart[$id] = [
        'id'=>$id,
        'name'=>$name,
        'price'=>$price,
        'quantity'=>$quantity,
        'image_url'=>$image_url,
        'subTotal'=>$total
    ];
}

$_SESSION['cart'] = $cart;
header('Content-Type: application/json');
echo json_encode(['status' => 'success', 'cartCount' => count($cart)]);
exit;