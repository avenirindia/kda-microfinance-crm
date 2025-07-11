<?php
include '../../config/db.php';

if(isset($_POST['add'])){
    $emp_name = $conn->real_escape_string($_POST['emp_name']);
    $mobile   = $conn->real_escape_string($_POST['mobile']);

    // Check duplicate
    $check = $conn->query("SELECT * FROM employees WHERE emp_name='$emp_name' AND mobile='$mobile'");
    if($check->num_rows > 0){
        echo "<div class='alert alert-danger'>❌ এই নাম ও মোবাইল নম্বর আগেই আছে!</div>";
    } else {
        $conn->query("INSERT INTO employees(emp_name, mobile) VALUES('$emp_name', '$mobile')");
        echo "<div class='alert alert-success'>✅ এমপ্লয়ি এড করা হলো!</div>";
    }
}
?>
