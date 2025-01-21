<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($role == 'admin') {
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = 'admin'";
        $redirect = 'admin_dashboard.php'; // Halaman dashboard admin
    } elseif ($role == 'customer') {
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = 'customer'";
        $redirect = 'index.php'; // Halaman dashboard customer
    } else {
        // Jika role tidak valid, tampilkan error
        $_SESSION['error_message'] = "Role tidak valid!";
        header("Location: login_error.php");
        exit;
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Set session untuk pengguna
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Redirect ke dashboard sesuai role
        header("Location: $redirect");
        exit;
    } else {
        // Jika username atau password salah, arahkan ke halaman kesalahan dengan pesan
        $_SESSION['error_message'] = "Username atau password salah!";
        header("Location: login_error.php");
        exit;
    }
}
