<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container w-25">
        <h2 class="text-center">Register</h2>
        <form action="includes/register.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">User Type</label>
                <select class="form-control" name="usertype" id="usertype" required>
                    <option value="admin">Admin</option>
                    <option value="faculty">Faculty</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="mb-3" id="collegeField" style="display: none;">
                <label class="form-label">College</label>
                <select class="form-control" name="collegeID">
                    <option value="">Select College</option>
                    <?php
                    require 'includes/dbc.inc.php';
                    $stmt = $pdo->query("SELECT CollegeID, CollegeName FROM College WHERE IsActive = 1");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='{$row['CollegeID']}'>{$row['CollegeName']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
            <p class="text-center mt-2">Already registered? <a href="login.php">Login</a></p>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#usertype").change(function() {
                if ($(this).val() == "student" || $(this).val() == "faculty") {
                    $("#collegeField").show();
                } else {
                    $("#collegeField").hide();
                }
            });
        });
    </script>
</body>
</html>
