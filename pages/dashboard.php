<?php
// pages/dashboard.php
session_start();
require_once '../database.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: http://uas.test/pages/profile.php");
    exit();
}

$page = $_GET['page'] ?? 'index';
$file = __DIR__ . "/dashboard/$page.php";

if (file_exists($file)) {
    include_once '../components/head.php';
    echo "<div class=' bg-gray-100 font-sans'>";
    include 'dashboard/partials/sidebar.php';
        echo "<div class='ml-[250px]'>";
        include $file;
        echo "</div>";
    echo "</div>";
} else {
    echo "Page not found.";
}
