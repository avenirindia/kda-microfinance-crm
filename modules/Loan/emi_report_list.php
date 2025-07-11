<?php
ob_clean();
ob_start();
?>
<?php
include '../../config/db.php';
?>

<!-- Filter Form -->
<h3>Filter EMI Report</h3>
<form method="get">
    From: <input type="date" name="from_date">
    To: <input type="date" name="to_date">
    Loan ID: <input type="text" name="loan_id">
    <input type="submit" value="Search">
</form>
<br>

<!-- PHP Query Part -->
<?php
$where = "WHERE 1=1";

if(!empty($_GET['from_date']) && !empty($_GET['to_date'])){
    $from = $_GET['from_date'];
    $to = $_GET['to_date'];
    $where .= " AND payment_date BETWEEN '$from' AND '$to'";
}

if(!empty($_GET['loan_id'])){
    $loan_id = $_GET['loan_id'];
    $where .= " AND loan_id='$loan_id'";
}

$sql = "SELECT * FROM emi_schedule $where ORDER BY payment_date ASC";

$result = $conn->query($sql);
?>

<!-- EMI Report Table -->
<table border="1" cellpadding="5">
<tr>
    <th>Loan ID</th>
    <th>Installment No</th>
    <th>Payment Date</th>
    <th>EMI Amount</th>
    <th>Status</th>
    <th>Receive Date</th>
    <th>Remarks</th>
</tr>

<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
            <td>".$row['loan_id']."</td>
            <td>".$row['installment_no']."</td>
            <td>".$row['payment_date']."</td>
            <td>".$row['emi_amount']."</td>
            <td>".$row['status']."</td>
            <td>".$row['payment_received_date']."</td>
            <td>".$row['remarks']."</td>
        </tr>";
    }
}else{
    echo "<tr><td colspan='7'>No EMI data found.</td></tr>";
}
?>
</table>
<?php
// Total EMI Paid
$sql_paid = "SELECT SUM(emi_amount) AS total_paid FROM emi_schedule WHERE status='Paid'";
$result_paid = $conn->query($sql_paid);
$row_paid = $result_paid->fetch_assoc();
$total_paid = $row_paid['total_paid'];

// Total EMI Due
$sql_due = "SELECT SUM(emi_amount) AS total_due FROM emi_schedule WHERE status='Pending'";
$result_due = $conn->query($sql_due);
$row_due = $result_due->fetch_assoc();
$total_due = $row_due['total_due'];
?>

<h3>Summary:</h3>
<p>Total EMI Paid: ৳ <?php echo number_format($total_paid, 2); ?></p>
<p>Total EMI Due: ৳ <?php echo number_format($total_due, 2); ?></p>
<?php
include '../../config/db.php';
require_once '../../pdf/tcpdf.php';

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'EMI Receive Report', 0, 1, 'C');
$pdf->Ln(5);

// Table header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(25, 7, 'Loan ID', 1);
$pdf->Cell(25, 7, 'Installment', 1);
$pdf->Cell(35, 7, 'Payment Date', 1);
$pdf->Cell(25, 7, 'EMI Amount', 1);
$pdf->Cell(25, 7, 'Status', 1);
$pdf->Cell(45, 7, 'Receive Date', 1);
$pdf->Ln();

// Data
$pdf->SetFont('helvetica', '', 11);
$sql = "SELECT * FROM emi_schedule ORDER BY payment_date ASC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    $pdf->Cell(25, 7, $row['loan_id'], 1);
    $pdf->Cell(25, 7, $row['installment_no'], 1);
    $pdf->Cell(35, 7, $row['payment_date'], 1);
    $pdf->Cell(25, 7, $row['emi_amount'], 1);
    $pdf->Cell(25, 7, $row['status'], 1);
    $pdf->Cell(45, 7, $row['payment_received_date'], 1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output('emi_report.pdf', 'I');
?>
<a href="emi_report_pdf.php" target="_blank">📄 Download PDF Report</a>
<br><br>
<?php
ob_clean();
ob_start();

include '../../config/db.php';
require_once '../../pdf/tcpdf.php';

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'EMI Receive Report', 0, 1, 'C');
$pdf->Ln(5);

// Table header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(25, 7, 'Loan ID', 1);
$pdf->Cell(25, 7, 'Installment', 1);
$pdf->Cell(35, 7, 'Payment Date', 1);
$pdf->Cell(25, 7, 'EMI Amount', 1);
$pdf->Cell(25, 7, 'Status', 1);
$pdf->Cell(45, 7, 'Receive Date', 1);
$pdf->Ln();

// Data
$pdf->SetFont('helvetica', '', 11);
$sql = "SELECT * FROM emi_schedule ORDER BY payment_date ASC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    $pdf->Cell(25, 7, $row['loan_id'], 1);
    $pdf->Cell(25, 7, $row['installment_no'], 1);
    $pdf->Cell(35, 7, $row['payment_date'], 1);
    $pdf->Cell(25, 7, $row['emi_amount'], 1);
    $pdf->Cell(25, 7, $row['status'], 1);
    $pdf->Cell(45, 7, $row['payment_received_date'], 1);
    $pdf->Ln();
}

ob_end_clean();
$pdf->Output('emi_report.pdf', 'I');
?>
