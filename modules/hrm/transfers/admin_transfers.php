<?php
include '../../../config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Transfers</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid #555; padding: 8px; }
        th { background-color: #ddd; }
    </style>
</head>
<body>

<h2>Employee Transfer List</h2>

<!-- Download CSV লিংক -->
<a href="admin_transfer_export.php">📥 Download Transfer CSV Report</a><br><br>

<table>
    <tr>
        <th>Employee Code</th>
        <th>Employee Name</th>
        <th>From Branch</th>
        <th>To Branch</th>
        <th>Transfer Date</th>
        <th>Remarks</th>
    </tr>

    <?php
    $res = $conn->query("SELECT t.*, e.emp_code, e.emp_name 
                         FROM employee_transfers t
                         JOIN employees e ON t.emp_id = e.id
                         ORDER BY t.transfer_date DESC");

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            echo "<tr>
                <td>{$row['emp_code']}</td>
                <td>{$row['emp_name']}</td>
                <td>{$row['from_branch']}</td>
                <td>{$row['to_branch']}</td>
                <td>{$row['transfer_date']}</td>
                <td>{$row['remarks']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No Transfer Records Found</td></tr>";
    }
    ?>
</table>

</body>
</html>
