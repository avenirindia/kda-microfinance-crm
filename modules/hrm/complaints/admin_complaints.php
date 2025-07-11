<?php
include '../config/db.php';

$res = $conn->query("SELECT c.*, e.emp_name, e.emp_code FROM employee_complaints c
                     JOIN employees e ON c.emp_id = e.id");

echo "<h2>All Complaints</h2>";
echo "<table border='1'>
<tr><th>Emp Code</th><th>Name</th><th>Type</th><th>Text</th><th>Status</th><th>Action</th></tr>";

while($row = $res->fetch_assoc()){
    echo "<tr>
    <td>".$row['emp_code']."</td>
    <td>".$row['emp_name']."</td>
    <td>".$row['complaint_type']."</td>
    <td>".$row['complaint_text']."</td>
    <td>".$row['status']."</td>
    <td>";

    if($row['status'] == 'Pending'){
        echo "<a href='resolve_complaint.php?id=".$row['id']."'>Mark Resolved</a>";
    } else {
        echo "Done";
    }

    echo "</td></tr>";
}
echo "</table>";
?>
