<?php
require 'dbc.inc.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $usertype = $_POST['usertype'];
    $collegeID = isset($_POST['collegeID']) ? $_POST['collegeID'] : NULL;

    $stmt = $pdo->prepare("INSERT INTO users (Username, Password, UserType, CollegeID) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$username, $password, $usertype, $collegeID])) {
        echo "<script>alert('Registration successful!'); window.location.href='../login.php';</script>";
    } else {
        echo "<script>alert('Error registering user'); window.location.href='../register.php';</script>";
    }
}
?>
