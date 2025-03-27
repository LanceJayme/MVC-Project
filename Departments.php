<?php 
require_once "includes/dbc.inc.php";

$CollegeID = $_GET['id'] ?? '';

try {
    // Fetch College Name
    $collegeQuery = "SELECT CollegeName FROM College WHERE CollegeID = :CollegeID;";
    $collegeStmt = $pdo->prepare($collegeQuery);
    $collegeStmt->bindParam(":CollegeID", $CollegeID);
    $collegeStmt->execute();
    $college = $collegeStmt->fetch(PDO::FETCH_ASSOC);

    // Fetch Departments
    $query = "SELECT * FROM Department WHERE CollegeID = :CollegeID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":CollegeID", $CollegeID);
    $stmt->execute();
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDelete(deptId, collegeId) {
            if (confirm('Are you sure you want to delete this department?')) {
                window.location.href = `includes/delete-Department.inc.php?id=${deptId}&collegeid=${collegeId}`;
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Department List (<?= $college['CollegeName'] ?? 'Unknown College' ?>)</h3>
            </div>
            
            <div class="card-body">
                <!-- Add Button -->
                <div class="d-flex mb-3">
                    <a href="Add-Department.php?id=<?= $CollegeID ?>" class="btn btn-success">Add Department</a>
                </div>

                <!-- Table -->
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Department ID</th>
                            <th>College ID</th>
                            <th>Department Name</th>
                            <th>Department Code</th>
                            <th>Active Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="department-table-body">
                        <?php foreach ($departments as $dep) : ?>
                            <tr>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
