<?php
include("../../config/db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Employee Deleted Successfully. <a href='emp_list.php'>Back to List</a>";
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
} else {
    echo "No employee ID received.";
}
?>
