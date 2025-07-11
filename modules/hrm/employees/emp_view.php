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
    <title>View Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2 class="my-3">Employee Details</h2>
    <p><strong>ID:</strong> <?= $row['id']; ?></p>
    <p><strong>Name:</strong> <?= $row['employee_name']; ?></p>
    <p><strong>Designation:</strong> <?= $row['designation']; ?></p>
    <a href="emp_list.php" class="btn btn-secondary">Back to List</a>
</body>
</html>
