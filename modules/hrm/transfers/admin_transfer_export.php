<?php
include '../../../config/db.php';

// CSV Header
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="employee_transfers_report.csv"');

// CSV Output Stream
$output = fopen('php://output', 'w');

// Header Row
fputcsv($output, array('Employee Code', 'Employee Name', 'From Branch', 'To Branch', 'Transfer Date', 'Remarks'));

// Data Fetch করে CSV তে বসানো
$res = $conn->query("SELECT t.*, e.emp_code, e.emp_name 
                     FROM employee_transfers t
                     JOIN employees e ON t.emp_id = e.id
                     ORDER BY t.transfer_date DESC");

while($row = $res->fetch_assoc()){
    fputcsv($output, array(
        $row['emp_code'],
        $row['emp_name'],
        $row['from_branch'],
        $row['to_branch'],
        $row['transfer_date'],
        $row['remarks']
    ));
}

// Output বন্ধ করা
fclose($output);
exit;
?>
