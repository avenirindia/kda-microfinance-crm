<?php
include '../../config/db.php'; // তোমার ডেটাবেজ কানেকশন ফাইল

?>

<!DOCTYPE html>
<html>
<head>
    <title>EMI Report</title>
</head>
<body>

<h2>📄 EMI Report</h2>

<!-- Filter Form -->
<h3>Filter EMI Report</h3>
<form method="get">
    From: <input type="date" name="from_date">
    To: <input type="date" name="to_date">
    Loan ID: <input type="text" name="loan_id">
    <input type="submit" value="Search">
</form>
<br>

<!-- EMI Report Table -->
<table border="1" cellpadding="5">
<tr>
    <th>Installment No.</th>
    <th>Loan ID</th>
    <th>Payment Date</th>
    <th>EMI Amount (₹)</th>
</tr>

<?php
// ফিল্টার কন্ডিশন
$where = "WHERE 1";

if(!empty($_GET['from_date'])){
    $from_date = $_GET['from_date'];
    $where .= " AND payment_date >= '$from_date'";
}

if(!empty($_GET['to_date'])){
    $to_date = $_GET['to_date'];
    $where .= " AND payment_date <= '$to_date'";
}

if(!empty($_GET['loan_id'])){
    $loan_id = $_GET['loan_id'];
    $where .= " AND loan_id = '$loan_id'";
}

// EMI Schedule টেবিল থেকে ডাটা আনছি
$query = "SELECT * FROM emi_schedule $where ORDER BY payment_date ASC";
$result = $conn->query($query);

$total_emi = 0; // মোট EMI-এর টোটাল রাখার ভ্যারিয়েবল

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['installment_no']."</td>";
        echo "<td>".$row['loan_id']."</td>";
        echo "<td>".$row['payment_date']."</td>";
        echo "<td>".$row['emi_amount']."</td>";
        echo "</tr>";

        $total_emi += $row['emi_amount']; // টোটাল যোগ করছি
    }

    // Total Row
    echo "<tr>
            <td colspan='3' align='right'><strong>Total EMI Amount:</strong></td>
            <td><strong>₹".number_format($total_emi, 2)."</strong></td>
          </tr>";

} else {
    echo "<tr><td colspan='4'>No EMI Records Found!</td></tr>";
}
?>
</table>

</body>
</html>
