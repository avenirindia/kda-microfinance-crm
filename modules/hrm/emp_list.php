<?php include '../../../config/db.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Employee List</h2>
    <a href="emp_add.php" class="btn btn-success mb-3">➕ Add New</a>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = $conn->query("SELECT * FROM employees ORDER BY id DESC");
            while($row = $res->fetch_assoc()){
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['emp_name']}</td>
                    <td>{$row['mobile']}</td>
                    <td>
                        <a href='emp_view.php?id={$row['id']}' class='btn btn-info btn-sm'>👁️ View</a>
                        <a href='emp_edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>✏️ Edit</a>
                        <a href='emp_delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>🗑️ Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
