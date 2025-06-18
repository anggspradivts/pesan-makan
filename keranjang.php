<?php
session_start();
include 'database.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Retrieve and sanitize form data
    $nama_menu = mysqli_real_escape_string($conn, $_POST['nama_menu']);
    $pemesan = mysqli_real_escape_string($conn, $_POST['pemesan']);
    $harga_satuan = (int)$_POST['harga_satuan'];
    $jumlah = (int)$_POST['jumlah'];
    $total_harga = (int)$_POST['total_harga'];

    // Insert data into cart_pengguna
    $sql = "INSERT INTO cart_pengguna (nama_menu, pemesan, harga_satuan, jumlah, total_harga)
            VALUES ('$nama_menu', '$pemesan', $harga_satuan, $jumlah, $total_harga)";

    if (mysqli_query($conn, $sql)) {
        echo "<p>Berhasil dimasukkan ke keranjang!</p>";
        // Optionally redirect or show cart
        // header("Location: keranjang_list.php"); exit();
    } else {
        echo "<p>Gagal menambahkan ke keranjang: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p>Data tidak lengkap atau form tidak disubmit dengan benar.</p>";
}
?>