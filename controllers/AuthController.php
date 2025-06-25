<?php
session_start();

function login($conn, $username, $password) {
    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Username dan password harus diisi.";
        header("Location: http://uas.test/pages/sign-in.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT `id`, `nama`, `password`, `role` FROM user WHERE `nama` = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && $password === $user['password']) {
        $_SESSION['user'] = [
            "id" => $user["id"],
            "nama" => $user["nama"],
            "role" => $user["role"],
        ];

        if ($user['role'] === 'admin') {
            header("Location: http://uas.test/pages/dashboard.php");
        } else {
            header("Location: http://uas.test");
        }
        exit();
    } else {
        $_SESSION['error_message'] = "Username atau password salah.";
        header("Location: http://uas.test/pages/sign-in.php");
        exit();
    }
}

function signup($conn, $username, $password, $role = 'user') {
    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Username dan password harus diisi.";
        header("Location: http://uas.test/pages/sign-up.php");
        exit();
    }

    $stmt_check = $conn->prepare("SELECT `nama` FROM user WHERE `nama` = ?");
    if (!$stmt_check) {
        die("Prepare check failed: " . $conn->error);
    }

    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $_SESSION['error_message'] = "Username sudah ada. Silakan pilih username lain.";
        header("Location: http://uas.test/pages/sign-up.php");
        exit();
    }
    $stmt_check->close();

    $stmt_insert = $conn->prepare("INSERT INTO user (`nama`, `password`, `role`) VALUES (?, ?, ?)");
    if (!$stmt_insert) {
        die("Prepare insert failed: " . $conn->error);
    }

    $stmt_insert->bind_param("sss", $username, $password, $role); // 🔒 Consider using password_hash
    if ($stmt_insert->execute()) {
        $_SESSION['success_message'] = "Registrasi berhasil! Silakan login.";
        header("Location: http://uas.test/pages/sign-in.php");
    } else {
        $_SESSION['error_message'] = "Registrasi gagal: " . $stmt_insert->error;
        header("Location: http://uas.test/pages/sign-up.php");
    }

    $stmt_insert->close();
    exit();
}

function logout() {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    header("Location: http://uas.test/pages/sign-in.php");
    exit();
}
