<?php
session_start();
include "koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    echo "<script>
        alert('Email dan Password tidak boleh kosong!');
        window.location.href = '../pages/login.php';
    </script>";
    exit;
}

$data = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'") or die(mysqli_error($connect));
$user = mysqli_fetch_assoc($data);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    echo "<script>
        alert('Login Berhasil');
        window.location.href = '../pages/dashboard.php';
    </script>";
} else {
    echo "<script>
        alert('Login Gagal!');
        window.location.href = '../pages/login.php';
    </script>";
}
?>
