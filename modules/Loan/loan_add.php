<?php
include '../../config/db.php';

if(isset($_POST['submit'])){
    $customer_name = $_POST['customer_name'];
    $loan_amount   = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $period_months = $_POST['period_months'];
    $start_date    = $_POST['start_date'];

    // Loan Insert
    $sql = "INSERT INTO loans (customer_name, loan_amount, interest_rate, period_months, start_date)
            VALUES ('$customer_name', '$loan_amount', '$interest_rate', '$period_months', '$start_date')";

    if($conn->query($sql) === TRUE){
        $loan_id = $conn->insert_id;

        // EMI Calculate
        $monthly_interest = ($loan_amount * ($interest_rate/100)) / $period_months;
        $emi_amount = ($loan_amount / $period_months) + $monthly_interest;

        // EMI Schedule Generate
        for($i=1; $i<=$period_months; $i++){
            $payment_date = date('Y-m-d', strtotime("+$i month", strtotime($start_date)));
            $sql_emi = "INSERT INTO emi_schedule (loan_id, installment_no, payment_date, emi_amount)
                        VALUES ('$loan_id', '$i', '$payment_date', '$emi_amount')";
            $conn->query($sql_emi);
        }

        echo "<p style='color:green;'>✅ Loan Added Successfully with EMI Schedule!</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . $conn->error . "</p>";
    }
}
?>
