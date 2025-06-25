<?php
session_start();
require_once __DIR__ . '/../../controllers/MenuController.php';
require_once __DIR__ . '/../..//database.php';


if (!$_SESSION['user'] || $_SESSION['user']['role'] !== 'admin') {
  header("Location: http://uas.test/pages/sign-in.php");
  exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $idMenu = (int) $_GET['id'];
  echo $idMenu;
  deleteMenu($conn, $idMenu);
} else {
  header("Location: ../dashboard.php?page=menu&error=invalid_id");
  exit;
}