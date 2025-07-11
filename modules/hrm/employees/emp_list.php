<?php include("../../config/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List | KDA Microfinance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container my-4">

    <h2 class="mb-4">Employee List</h2>

    <a href="emp_add.php" class="btn btn-primary mb-3">+ Add New Employee</a>

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM employees ORDER BY id DESC");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['employee_name']}</td>
                        <td>{$row['designation']}</td>
                        <td>
                            <a href='emp_view.php?id={$row['id']}' class='btn btn-info btn-sm'>View</a>
                            <a href='emp_edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='emp_delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this employee?');\">Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No Employees Found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
