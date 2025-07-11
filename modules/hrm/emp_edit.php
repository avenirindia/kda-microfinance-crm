<?php
include '../../../config/db.php';
$id = $_GET['id'];
$get = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $get->fetch_assoc();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Edit Employee</h2>
    <form method="post">
        <div class="mb-2">
            <label>Name:</label>
            <input type="text" name="emp_name" value="<?php echo $data['emp_name']; ?>" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Mobile:</label>
            <input type="text" name="mobile" value="<?php echo $data['mobile']; ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">✅ Update</button>
        <a href="emp_list.php" class="btn btn-secondary">🔙 Back</a>
    </form>
</div>

<?php
if(isset($_POST['update'])){
    $emp_name = $conn->real_escape_string($_POST['emp_name']);
    $mobile   = $conn->real_escape_string($_POST['mobile']);
    $conn->query("UPDATE employees SET emp_name='$emp_name', mobile='$mobile' WHERE id='$id'");
    echo "<script>alert('✅ Updated Successfully!'); window.location='emp_list.php';</script>";
}
?>
