<?php
include '../../config/db.php';

if(isset($_POST['save'])){
    $branch_id = $_POST['branch_id'];
    $name      = $_POST['emp_name'];
    $desig     = $_POST['emp_designation'];
    $mobile    = $_POST['emp_mobile'];
    $email     = $_POST['emp_email'];
    $join      = $_POST['emp_join_date'];
    $ctc       = $_POST['ctc'];

    $sql = "INSERT INTO hrm_employees (branch_id, emp_name, emp_designation, emp_mobile, emp_email, emp_join_date, ctc)
            VALUES ('$branch_id', '$name', '$desig', '$mobile', '$email', '$join', '$ctc')";

    if($conn->query($sql)){
        echo "✅ Employee Added Successfully!";
    } else {
        echo "❌ Error: ".$conn->error;
    }
}
?>

<h3>Employee Joining Form</h3>
<form method="POST">
    Branch ID: <input type="text" name="branch_id" required><br>
    Name: <input type="text" name="emp_name" required><br>
    Designation: <input type="text" name="emp_designation" required><br>
    Mobile: <input type="text" name="emp_mobile" required><br>
    Email: <input type="email" name="emp_email"><br>
    Joining Date: <input type="date" name="emp_join_date" required><br>
    CTC: <input type="number" name="ctc" required><br>
    <input type="submit" name="save" value="Save">
</form>
