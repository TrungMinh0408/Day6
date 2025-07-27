<?php
session_start();

// include_once(__DIR__ . '/../../dbConnect.php');

$id = $_POST['id'];

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    if(isset($cart[$id])){
        unset($cart[$id]);
        $_SESSION['cart'] = $cart;
    }
}

echo json_encode($_SESSION['cart']);