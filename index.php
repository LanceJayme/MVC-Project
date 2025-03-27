<?php 
require_once "includes/dbc.inc.php";

try {
    $query = "SELECT * FROM college;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $college = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function searchCollege() {
            let searchValue = document.getElementById("search-input").value;
            fetch(`includes/search.php?search=${searchValue}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById("college-table-body");
                    tableBody.innerHTML = ""; // Clear existing data
                    
                    data.forEach(college => {
                        let row = `<tr>
                            <td>${college.CollegeID}</td>
                            <td>${college.CollegeName}</td>
                            <td>${college.CollegeCode}</td>
                            <td>${college.IsActive}</td>
                            <td>
                                <a href="Departments.php?id=${college.CollegeID}">Department</a>
                                <a href="Edit-College.php?id=${college.CollegeID}">Edit</a> 
                                <a href="#" onclick="confirm('Are you sure you want to delete this college?') ? window.location.href='includes/delete-College.inc.php?id=${college.CollegeID}' : ''">Delete</a>
                            </td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                });
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>College List</h3>
            </div>
            <div class="card-body">
                <!-- Search Bar -->
                <div class="d-flex mb-3">
                    <input type="text" id="search-input" class="form-control me-2" placeholder="Search by College ID, Name, or Code" onkeyup="searchCollege()">
                    <button class="btn btn-secondary" onclick="searchCollege()">Search</button>
                    <a href="Add-College.php" class="btn btn-success ms-2">Add</a>
                </div>
                
                <!-- Table -->
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>College ID</th>
                            <th>College Name</th>
                            <th>College Code</th>
                            <th>Active Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="college-table-body">
                        <?php foreach ($college as $coll): ?>
                            <tr>
                                <td><?= $coll['CollegeID'] ?></td>
                                <td><?= $coll['CollegeName'] ?></td>
                                <td><?= $coll['CollegeCode'] ?></td>
                                <td><?= $coll['IsActive'] ?></td>
                                <td>
                                    <a href="Departments.php?id=<?= $coll['CollegeID'] ?>">Department</a>
                                    <a href="Edit-College.php?id=<?= $coll['CollegeID'] ?>">Edit</a> 
                                    <a href="#" onclick="confirm('Are you sure you want to delete this college?') ? window.location.href='includes/delete-College.inc.php?id=<?= $coll['CollegeID'] ?>' : ''">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
