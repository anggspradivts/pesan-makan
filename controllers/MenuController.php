<?php

function getMenu(mysqli $conn, string $kategori): array {
    $sql = "SELECT id, nama, harga, kategori FROM menu WHERE kategori = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $data;
}

function getMenuDetail(mysqli $conn, int $idMenu): ?array {
    $sql = "SELECT * FROM menu WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idMenu);
    $stmt->execute();
    $result = $stmt->get_result();
    $menu = $result->fetch_assoc();
    $stmt->close();
    return $menu ?: null;
}

function addMenu(mysqli $conn, string $nama, string $deskripsi, int $harga, string $kategori): bool {
    $sql = "INSERT INTO menu (nama, deskripsi, harga, kategori) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $nama, $deskripsi, $harga, $kategori);
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: http://uas.test/pages/dashboard.php?page=menu');
        exit();
    } else {
        $_SESSION['error_message'] = "Gagal menambahkan menu ke database: " . $stmt->error;
        $stmt->close();
        return false;
    }
}

function editMenu(mysqli $conn, string $nama, string $deskripsi, int $harga, string $kategori, int $id): bool {
    $sql = "UPDATE menu SET nama = ?, deskripsi = ?, harga = ?, kategori = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $nama, $deskripsi, $harga, $kategori, $id);
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: http://uas.test/pages/dashboard.php?page=menu');
        exit();
    } else {
        $_SESSION['error_message'] = "Gagal mengupdate menu: " . $stmt->error;
        $stmt->close();
        return false;
    }
}

function deleteMenu(mysqli $conn, int $id): bool {
    $sql_delete = "DELETE FROM menu WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    if ($stmt_delete->execute()) {
        $stmt_delete->close();
        header('Location: http://uas.test/pages/dashboard.php?page=menu');
        exit();
    } else {
        $_SESSION['error_message'] = "Gagal menghapus menu: " . $stmt_delete->error;
        $stmt_delete->close();
        return false;
    }
}