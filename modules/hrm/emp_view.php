<?php
include '../../../config/db.php';
$id = $_GET['id'];
$get = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $get->fetch_assoc();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>View Employee Details</h2>
    <div class="card p-3">
        <h5>Name: <?php echo $data['emp_name']; ?></h5>
        <p>Mobile: <?php echo $data['mobile']; ?></p>
        <a href="emp_list.php" class="btn btn-secondary">🔙 Back</a>
    </div>
</div>
