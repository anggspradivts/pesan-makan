<?php
  session_start();

  require 'routes.php';

  $route = $_GET['page'] ?? 'home';

  // mencari id menu makanan
  $makanan_id = basename($route);
  handleRoute($route, $makanan_id);
?>