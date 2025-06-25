<?php
require_once __DIR__. '/../../database.php'; 
require_once __DIR__. '/../../controllers/AuthController.php';

$username = $_POST['username'];
$password = $_POST['password'];

signup($conn, $username, $password);