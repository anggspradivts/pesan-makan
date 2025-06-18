<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
    }

    .login-container {
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #0056b3;
    }

    .message {
      color: red;
      margin-bottom: 10px;
    }

    .success-message {
      color: green;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php
    if (isset($_SESSION['error_message'])) {
      echo '<p class="message">' . $_SESSION['error_message'] . '</p>';
      unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
    }
    if (isset($_SESSION['success_message'])) {
      echo '<p class="success-message">' . $_SESSION['success_message'] . '</p>';
      unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan
    }
    ?>
    <form action="../auth/sign-in.php" method="POST">
      <input type="hidden" name="action" value="login">
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password" required><br><br>
      <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="sign-up.php">Daftar di sini</a>.</p>
  </div>
</body>

</html>