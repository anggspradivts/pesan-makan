<?php
require_once __DIR__ . "/../../database.php";
require_once __DIR__ . "/../../controllers/CartController.php";

$menuId = $_POST['menu_id'];
$userId = $_SESSION['user']['id'] ?? null;
$quantity = $_POST['quantity'];

if (!isset($userId)) {
    header("Location: http://uas.test/pages/sign-in.php");
    exit();
} else {
    $addCart = addToCart($conn, $userId, $menuId, $quantity);
}