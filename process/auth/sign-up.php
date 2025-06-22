<?php
require_once __DIR__. '/../../database.php'; 
require_once __DIR__. '/../../controllers/AuthController.php';

$auth = new AuthController($conn);
$auth->signup($_POST['username'], $_POST['password']);