<a href="admin_resignations_export.php">📥 Download CSV Report</a><br><br>
<?php
include '../config/db.php';

// CSV header set করা
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="resignations_report.csv"');

// CSV output stream
$output = fopen('php://output', 'w');

// CSV Header row
fputcsv($output, array('Emp Code', 'Employee Name', 'Resignation Date', 'Reason', 'Status', 'Relieving Date'));

// ডেটা ফেচ করে CSV-তে লিখা
$res = $conn->query("SELECT r.*, e.emp_name, e.emp_code FROM resignations r
                     JOIN employees e ON r.emp_id = e.id
                     ORDER BY r.id DESC");

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

// CSV stream বন্ধ করা
fclose($output);
exit;
?>
