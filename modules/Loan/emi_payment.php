<?php
include '../../config/db.php';

// Update EMI status to Paid
if (isset($_GET['pay'])) {
    $emi_id = $_GET['pay'];

    $update = "UPDATE emi_schedule SET status='Paid' WHERE id='$emi_id'";
    if ($conn->query($update)) {
        echo "<p style='color:green;'>✅ EMI Payment Received Successfully!</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . $conn->error . "</p>";
    }
}

// Fetch Pending EMIs
$sql = "SELECT emi_schedule.*, loans.loan_amount 
        FROM emi_schedule 
        INNER JOIN loans ON emi_schedule.loan_id = loans.id
        WHERE emi_schedule.status='Pending' 
        ORDER BY payment_date ASC";

$result = $conn->query($sql);
?>

<h2>Pending EMI Payments</h2>

<table border="1" cellpadding="6">
    <tr style="background-color:#ddd;">
        <th>ID</th>
        <th>Loan ID</th>
        <th>Installment No.</th>
        <th>Payment Date</th>
        <th>EMI Amount</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['loan_id']."</td>
            <td>".$row['installment_no']."</td>
            <td>".$row['payment_date']."</td>
            <td>₹".$row['emi_amount']."</td>
            <td>".$row['status']."</td>
            <td><a href='emi_payment.php?pay=".$row['id']."'>✅ Receive</a></td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='7' style='text-align:center;'>No pending EMI found.</td></tr>";
}
?>

</table>
