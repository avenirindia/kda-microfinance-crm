<?php
include '../../../config/db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM employees WHERE id='$id'");
header("Location: emp_list.php");
?>
