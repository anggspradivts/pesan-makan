<?php
session_start();
require_once __DIR__ . '/../../controllers/MenuController.php';
require_once __DIR__ . '/../..//database.php';


if (!$_SESSION['username'] || $_SESSION['role'] !== 'admin') {
  header("Location: http://uas.test/pages/sign-in.php");
  exit;
}

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$kategori = $_POST['kategori'];

if (!$id) {
  $_SESSION["error_message"] = "Menu tidak ditemukan";
}
$menu = new MenuController($conn);
$menu->editMenu($nama, $deskripsi, $harga, $kategori, $id);