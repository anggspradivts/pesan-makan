<?php
require_once __DIR__ . "/../../database.php";
require_once __DIR__ . "/../../controllers/CartController.php";

$menuId = $_POST['menu_id'];
$quantity = $_POST['quantity'];
$operation_method = $_POST['operation_method'];
$userId = $_SESSION['user']['id'] ?? null;

if (!isset($userId)) {
    header("Location: http://uas.test/pages/sign-in.php");
    exit();
} else {
    $editCartItem = updateCartQuantity($conn, $userId, $menuId, $quantity, $operation_method);
}