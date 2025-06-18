<?php
require_once '../database.php'; 
require_once '../controllers/AuthController.php';

$auth = new AuthController($conn);
$auth->login($_POST['username'], $_POST['password']);