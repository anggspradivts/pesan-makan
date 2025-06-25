<?php
require_once __DIR__ . "/../../database.php";
require_once __DIR__ . "/../../controllers/CartController.php";

$menuId = $_POST['menu_id'];
$userId = $_SESSION['user']['id'] ?? null;
$quantity = $_POST['quantity'];


$addCart = addToCart($conn, $userId, $menuId, $quantity);
if ($addCart) {
    header("Location: http://uas.test/pages/cart.php");
} else {
    header("Location: http://uas.test");
}