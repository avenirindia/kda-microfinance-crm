<?php
include '../../config/db.php';

echo "<h3>Employee List</h3>";
echo "<table border='1' cellpadding='5'>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Designation</th>
  <th>Mobile</th>
  <th>Email</th>
  <th>Join Date</th>
  <th>CTC</th>
  <th>Status</th>
</tr>";

$sql = "SELECT * FROM hrm_employees ORDER BY emp_name ASC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo "<tr>
      <td>{$row['id']}</td>
      <td>{$row['emp_name']}</td>
      <td>{$row['emp_designation']}</td>
      <td>{$row['emp_mobile']}</td>
      <td>{$row['emp_email']}</td>
      <td>{$row['emp_join_date']}</td>
      <td>{$row['ctc']}</td>
      <td>{$row['status']}</td>
    </tr>";
}
echo "</table>";
?>
