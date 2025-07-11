<?php
include("../../config/db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM employees WHERE id='$id'");
    $row = $result->fetch_assoc();
} else {
    echo "No ID Found!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="my-3">Edit Employee</h2>
    <form action="emp_update.php" method="post">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <div class="mb-3">
            <label>Employee Name</label>
            <input type="text" name="employee_name" value="<?= $row['employee_name']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" value="<?= $row['designation']; ?>" class="form-control" required>
        </div>
        <input type="submit" value="Update Employee" class="btn btn-primary">
    </form>
</body>
</html>
