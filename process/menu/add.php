<?php
  session_start();
  require_once __DIR__. '/../../controllers/MenuController.php';
  require_once __DIR__. '/../..//database.php';

  
  if(!$_SESSION['user'] || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /pages/sign-in.php");
    exit;
  }
  
  $namaMenu = $_POST['nama-menu'];
  $hargaMenu = $_POST['harga-menu'];
  $kategoriMenu = $_POST['kategori-menu'];
  $deskripsiMenu = $_POST['deskripsi-menu'];
  addMenu($conn, $namaMenu, $deskripsiMenu, $hargaMenu, $kategoriMenu);
?>