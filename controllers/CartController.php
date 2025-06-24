<?php
session_start();

class CartController
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function addCart($userId, $menuId, $quantity = 1)
    {
        $stmt = $this->conn->prepare("SELECT id, quantity FROM carts WHERE user_id = ? AND menu_id = ?");
        $stmt->bind_param("ii", $userId, $menuId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Item already in cart, update quantity
            $newQty = $row['quantity'] + $quantity;
            $update = $this->conn->prepare("UPDATE carts SET quantity = ? WHERE id = ?");
            $update->bind_param("ii", $newQty, $row['id']);
            $update->execute();
        } else {
            // Insert new cart item
            $insert = $this->conn->prepare("INSERT INTO carts (user_id, menu_id, quantity) VALUES (?, ?, ?)");
            $insert->bind_param("iii", $userId, $menuId, $quantity);
            $insert->execute();
        }
    }

    public function editCart($userId, $menuId, $quantity)
    {
        if ($quantity > 0) {
            $stmt = $this->conn->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND menu_id = ?");
            $stmt->bind_param("iii", $quantity, $userId, $menuId);
            $stmt->execute();
        } else {
            $this->deleteCart($userId, $menuId); // Delete if quantity is 0 or less
        }
    }

    // Delete a specific cart item
    public function deleteCart($userId, $menuId)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE user_id = ? AND menu_id = ?");
        $stmt->bind_param("ii", $userId, $menuId);
        $stmt->execute();
    }

    // Get all cart items for a user (optionally joined with menu info)
    public function getCart($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT c.menu_id, c.quantity, m.nama, m.harga 
            FROM carts c
            JOIN menu m ON c.menu_id = m.id
            WHERE c.user_id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $cartItems = [];
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }

        return $cartItems;
    }
}
