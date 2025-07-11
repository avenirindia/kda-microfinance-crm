<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid Access!');
}

// নিচে বাকি ইনসার্ট কোড
<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid Access!');
}

$loan_amount = $_POST['loan_amount'];
$interest_rate = $_POST['interest_rate'];
$period_months = $_POST['period_months'];
$start_date = $_POST['start_date'];
$emi = $_POST['emi'];

$insertLoan = "INSERT INTO loans (loan_amount, interest_rate, period_months, start_date) 
               VALUES ('$loan_amount', '$interest_rate', '$period_months', '$start_date')";

if ($conn->query($insertLoan)) {
    $loan_id = $conn->insert_id;

    for ($i = 1; $i <= $period_months; $i++) {
        $payment_date = date('Y-m-d', strtotime("+$i month", strtotime($start_date)));

        $insertEMI = "INSERT INTO emi_schedule (loan_id, installment_no, payment_date, emi_amount) 
                      VALUES ('$loan_id', '$i', '$payment_date', '$emi')";

        $conn->query($insertEMI);
    }

    echo "<p style='color:green;'>✅ EMI Schedule Successfully Saved to Database!</p>";
} else {
    echo "❌ Loan Insert Error: " . $conn->error;
}

