<?php
session_start();
require_once __DIR__ . "/../../database.php";
require_once __DIR__ . "/../../controllers/OrderController.php";

$orderId = (int) $_POST['order_id'];
$orderStatus = $_POST['status_pesanan'];


$editOrderStatus = editAdminOrders($conn, $orderStatus, $orderId);
if ($editOrderStatus) {
    header("Location: http://uas.test/pages/dashboard.php?page=orders");
} else {
    header("Location: http://uas.test/pages/dashboard.php?page=orders");
}