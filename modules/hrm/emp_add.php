<?php include '../../../config/db.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Add New Employee</h2>
    <form action="emp_add_save.php" method="post">
        <div class="mb-2">
            <label>Name:</label>
            <input type="text" name="emp_name" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Mobile:</label>
            <input type="text" name="mobile" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">➕ Add Employee</button>
        <a href="emp_list.php" class="btn btn-secondary">📋 View Employees</a>
    </form>
</div>
