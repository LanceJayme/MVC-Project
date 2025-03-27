<?php
session_start();
require 'includes/dbc.inc.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$collegeID = $user['CollegeID'];

// Fetch departments for the user's college
$stmt = $pdo->prepare("SELECT * FROM department WHERE CollegeID = ?");
$stmt->execute([$collegeID]);
$departments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Welcome, <?php echo htmlspecialchars($user['Username']); ?>!</h2>
    <h4>Your Departments</h4>
    <ul class="list-group">
        <?php foreach ($departments as $dept) : ?>
            <li class="list-group-item"><?php echo htmlspecialchars($dept['DepartmentName']); ?></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <a href="login.php" class="btn btn-danger">Logout</a>
</body>
</html>
