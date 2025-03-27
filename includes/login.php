<?php
session_start();
require 'dbc.inc.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE Username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['user'] = $user;

        // Redirect based on user type
        if ($user['UserType'] == 'admin') {
            header("Location: ../index.php"); // Admin dashboard
        } else {
            header("Location: ../dashboard.php"); // Student/Faculty dashboard
        }
        exit();
    } else {
        echo "<script>alert('Invalid credentials'); window.location.href='login.php';</script>";
    }
}
?>
