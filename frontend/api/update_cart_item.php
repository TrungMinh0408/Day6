<?php
session_start();

include_once(__DIR__ . '/../../dbConnect.php');

$id = $_POST['id'];
$quantity = $_POST['quantity'];
// $quantity = 1;

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
  $tmpProd = $cart[$id];
  $cart[$id]= [
    'id' => $tmpProd['id'],
    'name'=>$tmpProd['name'],
    'price'=>$tmpProd['price'],
    'quantity'=>$quantity,
    'image_url'=>$tmpProd['image_url'],
    'subTotal'=>$tmpProd['price'] * $quantity,
  ];

   $_SESSION['cart'] = $cart;
}

echo json_encode($_SESSION['cart']);
