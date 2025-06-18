<?php
function handleRoute($route, $makanan_id)
{
  switch ($route) {
    case 'home':
      require 'pages/home.php';
      break;
    case 'about':
      require 'pages/about.php';
      break;
    case 'contact':
      require 'pages/contact.php';
      break;
    case 'makanan/' . $makanan_id:
      require 'pages/makanan-detail.php';
      break;
    default:
      require 'pages/not-found.php';
      // http_response_code(404);
      // echo "Page not found";
  }
}
