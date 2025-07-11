<?php
include '../config/db.php';   // এখানে শুধু এই লাইন

if(isset($_POST['emp_code'])){
    $emp_code = $_POST['emp_code'];

    $empResult = $conn->query("SELECT id, emp_name, current_designation FROM employees WHERE emp_code='$emp_code'");
    // ...বাকি কোড
}
?>
