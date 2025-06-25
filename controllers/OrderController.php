<?php
require_once __DIR__ . '/../database.php';

function createOrder(mysqli $conn, int $userId, array $cartItems, int $total_harga, string $statusPesanan = "diproses")
{
    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert into orders table
        $stmtOrder = $conn->prepare("INSERT INTO pesanan (user_id, status_pesanan, total_harga, tanggal_pesan) VALUES (?, ?, ?, NOW())");
        $stmtOrder->bind_param("isi", $userId, $statusPesanan, $total_harga);
        $stmtOrder->execute();
        $orderId = $stmtOrder->insert_id;
        $stmtOrder->close();

        // Insert each item into order_items
        $stmtItem = $conn->prepare("INSERT INTO pesanan_detail (pesanan_id, menu_id, jumlah) VALUES (?, ?, ?)");
        foreach ($cartItems as $item) {
            $menuId = $item['menu_id'];
            $jumlah = $item['quantity'];
            // $price = $item['harga'];
            $stmtItem->bind_param("isi", $orderId, $menuId, $jumlah);
            $stmtItem->execute();
        }
        $stmtItem->close();

        // Clear the user's cart
        $stmtClear = $conn->prepare("DELETE FROM carts WHERE user_id = ?");
        $stmtClear->bind_param("i", $userId);
        $stmtClear->execute();
        $stmtClear->close();

        // Commit transaction
        $conn->commit();
        return true;
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error_message'] = "Failed to place order: " . $e->getMessage();
        return false;
    }
}

function getOrderHistory(mysqli $conn, int $userId): array
{
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $orders;
}

function getOrderDetails(mysqli $conn, int $orderId): array
{
    $stmt = $conn->prepare("
        SELECT oi.menu_id, oi.quantity, oi.price, m.nama 
        FROM order_items oi
        JOIN menu m ON oi.menu_id = m.id
        WHERE oi.order_id = ?
    ");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $items;
}
