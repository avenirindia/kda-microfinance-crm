<?php
include '../config/db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn->query("UPDATE employee_complaints SET status='Resolved' WHERE id='$id'");
    echo "<h3>✅ Complaint Resolved</h3>";
    echo "<a href='admin_complaints.php'>Back to Complaints</a>";
}
?>
