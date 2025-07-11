<?php
include '../../../config/db.php';

$emp_name = $conn->real_escape_string($_POST['emp_name']);
$mobile   = $conn->real_escape_string($_POST['mobile']);

$check = $conn->query("SELECT * FROM employees WHERE emp_name='$emp_name' AND mobile='$mobile'");
if($check->num_rows > 0){
    echo "<script>alert('❌ Employee already exists!'); window.location='emp_add.php';</script>";
} else {
    $conn->query("INSERT INTO employees(emp_name, mobile) VALUES('$emp_name', '$mobile')");
    echo "<script>alert('✅ Employee added successfully!'); window.location='emp_list.php';</script>";
}
?>
