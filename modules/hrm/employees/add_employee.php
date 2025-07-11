<?php include '../../../config/db.php'; ?>
<?php
include '../../../config/db.php';

if(isset($_POST['add'])){
    $name = $conn->real_escape_string($_POST['emp_name']);
    $mobile = $conn->real_escape_string($_POST['mobile']);

    $check = $conn->query("SELECT * FROM employees WHERE emp_name='$name' AND mobile='$mobile'");
    if($check->num_rows > 0){
        echo "Duplicate Entry!";
    } else {
        $conn->query("INSERT INTO employees(emp_name, mobile) VALUES('$name', '$mobile')");
        echo "Employee Added!";
    }
}
?>
