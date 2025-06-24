<?php
session_start();
require_once __DIR__. "/../../database.php";
require_once __DIR__. "/../../controllers/CartController.php";

$menuId = $_POST['menu_id'];
$userId = $_POST['user_id'];
$quantity = $_POST['quantity'];

$cartController = new CartController($conn);
$cartController->addCart($userId, $menuId, $quantity);
?>