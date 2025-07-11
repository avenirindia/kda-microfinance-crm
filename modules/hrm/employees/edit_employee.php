<?php
include '../../config/db.php';

$id = $_GET['id'];
$get = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $get->fetch_assoc();

if(isset($_POST['update'])){
    $emp_name = $conn->real_escape_string($_POST['emp_name']);
    $mobile   = $conn->real_escape_string($_POST['mobile']);

    $conn->query("UPDATE employees SET emp_name='$emp_name', mobile='$mobile' WHERE id='$id'");
    header("Location: list_employee.php");
}
?>

<div class="container mt-4">
    <h3>Edit Employee</h3>
    <form method="post">
        <div class="mb-2">
            <label>Name:</label>
            <input type="text" class="form-control" name="emp_name" value="<?php echo $data['emp_name']; ?>" required>
        </div>
        <div class="mb-2">
            <label>Mobile:</label>
            <input type="text" class="form-control" name="mobile" value="<?php echo $data['mobile']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">✅ Update</button>
    </form>
</div>
