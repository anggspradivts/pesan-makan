<?php

  $page = $_GET['page'] ?? '';
// Get the last part after the slash
$id = basename($page);

echo "The id is: " . htmlspecialchars($id);

?>