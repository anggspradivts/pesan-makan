<?php
session_start();


// Add item to cart
function addToCart($conn, $userId, $menuId, $quantity = 1)
{
    $stmt = $conn->prepare("SELECT id, quantity FROM carts WHERE user_id = ? AND menu_id = ?");
    $stmt->bind_param("ii", $userId, $menuId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Item exists, update quantity
        $newQty = $row['quantity'] + $quantity;
        $update = $conn->prepare("UPDATE carts SET quantity = ? WHERE id = ?");
        $update->bind_param("ii", $newQty, $row['id']);
        $update->execute();
        $_SESSION["success_message"] = "Berhasil menambahkan menu ke cart!";
    } else {
        // New item
        $insert = $conn->prepare("INSERT INTO carts (user_id, menu_id, quantity) VALUES (?, ?, ?)");
        $insert->bind_param("iii", $userId, $menuId, $quantity);
        $insert->execute();
    }

    header("Location: http://uas.test/pages/menu-detail.php?id=$menuId");
    exit();
}

// Edit cart item quantity
function updateCartQuantity($conn, $userId, $menuId, $quantity, $operation_method)
{
    if ($operation_method === "increase") {
        $quantity++; // add 1
    } elseif ($operation_method === "decrease") {
        $quantity--; // subtract 1
    }

    if ($quantity > 0) {
        $stmt = $conn->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND menu_id = ?");
        $stmt->bind_param("iii", $quantity, $userId, $menuId);
        $stmt->execute();
        $stmt->close();
        header("Location: http://uas.test/pages/cart.php");
    } else {
        // If quantity becomes 0 or less, delete the cart item
        deleteCartItem($conn, $userId, $menuId);
        header("Location: http://uas.test/pages/cart.php");
    }
}


// Delete specific cart item
function deleteCartItem($conn, $userId, $menuId)
{
    $stmt = $conn->prepare("DELETE FROM carts WHERE user_id = ? AND menu_id = ?");
    $stmt->bind_param("ii", $userId, $menuId);
    $stmt->execute();
}

// Get all items in the cart for a user
function getCartItems($conn, $userId)
{
    $stmt = $conn->prepare("
        SELECT *
        FROM carts c
        LEFT JOIN menu m ON c.menu_id = m.id
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
