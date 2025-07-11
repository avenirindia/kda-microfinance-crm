<?php
include("../../config/db.php");

$id = $_POST['id'];
$employee_name = $conn->real_escape_string($_POST['employee_name']);
$designation = $conn->real_escape_string($_POST['designation']);

$sql = "UPDATE employees SET employee_name='$employee_name', designation='$designation' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Employee Updated Successfully. <a href='emp_list.php'>Back to List</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
