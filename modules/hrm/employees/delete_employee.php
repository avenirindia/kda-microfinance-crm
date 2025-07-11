<?php
include '../../config/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM employees WHERE id='$id'");
header("Location: list_employee.php");
?>
