<?php include("../../config/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="my-3">Add New Employee</h2>
    <form action="emp_add_save.php" method="post">
        <div class="mb-3">
            <label>Employee Name</label>
            <input type="text" name="employee_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" required>
        </div>
        <input type="submit" value="Save Employee" class="btn btn-success">
    </form>
</body>
</html>
