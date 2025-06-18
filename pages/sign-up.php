<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f0f0; }
        .signup-container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type="text"], input[type="password"], select { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background-color: #218838; }
        .message { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Daftar Akun Baru</h2>
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<p class="message">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
        }
        ?>
        <form action="../auth/sign-up.php" method="POST">
            <input type="hidden" name="action" value="signup">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="sign-in.php">Login di sini</a>.</p>
    </div>
</body>
</html>