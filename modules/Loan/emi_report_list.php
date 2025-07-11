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
