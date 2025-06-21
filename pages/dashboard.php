<?php
// pages/dashboard.php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$page = $_GET['page'] ?? 'index';
$file = __DIR__ . "/dashboard/$page.php";

if (file_exists($file)) {
    include '../components/head.php';
    echo "<div class='flex bg-gray-100 font-sans'>";
    include 'dashboard/partials/sidebar.php';
    include $file;
    echo "</div>";
    // include 'dashboard/partials/footer.php';
} else {
    echo "Page not found.";
}
