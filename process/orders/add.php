<?php
session_start();
require_once __DIR__ . "/../../database.php";
require_once __DIR__ . "/../../controllers/OrderController.php";

$totalPrice = (float) $_POST['total_price'];
var_dump($totalPrice);
$cartItems = isset($_POST['cart_items']) ? json_decode($_POST['cart_items'], true) : null;
$userId = $_SESSION['user']['id'];


$createOrder = createOrder($conn, $userId, $cartItems, $totalPrice);
if ($createOrder) {
    header("Location: http://uas.test");
} else {
    header("Location: http://uas.test/pages/cart.php");
}