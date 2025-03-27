<?php
require_once "dbc.inc.php";

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

try {
    if (!empty($search)) {
        $query = "SELECT * FROM college WHERE CollegeID LIKE ? OR CollegeName LIKE ? OR CollegeCode LIKE ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(["%$search%", "%$search%", "%$search%"]);
    } else {
        $query = "SELECT * FROM college";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }