<?php
include '../config/db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="resignations_report.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, array('Emp Code', 'Name', 'Resignation Date', 'Reason', 'Status', 'Relieving Date'));

$res = $conn->query("SELECT r.*, e.emp_name, e.emp_code FROM resignations r
                     JOIN employees e ON r.emp_id = e.id");

while($row = $res->fetch_assoc()){
    fputcsv($output, array(
        $row['emp_code'],
        $row['emp_name'],
        $row['resignation_date'],
        $row['reason'],
        $row['status'],
        $row['relieving_date']
    ));
}

fclose($output);
exit;
?>
