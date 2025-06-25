<?php
require_once __DIR__ . "/../../database.php";
require_once __DIR__ . "/../../controllers/CartController.php";

$menuId = $_POST['menu_id'];
$userId = $_SESSION['user']['id'] ?? null;

$deleteCartItem = deleteCartItem($conn, $userId, $menuId);

if ($deleteCartItem) {
    $_SESSION["success_message"] = "Berhasil menghapus";
    header("Location: http://uas.test/pages/cart.php");
} else {
    $_SESSION["error_message"] = "Gagal menghapus";
    header("Location: http://uas.test");
}