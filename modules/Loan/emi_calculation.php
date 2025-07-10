<?php
if(isset($_POST['calculate'])){
    $loan_amount   = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $period_months = $_POST['period_months'];
    $start_date    = $_POST['start_date'];

    // EMI Formula: [P x R x (1+R)^N] / [(1+R)^N-1]
    $monthly_interest_rate = ($interest_rate / 12) / 100;
    $emi = ($loan_amount * $monthly_interest_rate * pow(1+$monthly_interest_rate, $period_months)) / 
           (pow(1+$monthly_interest_rate, $period_months)-1);

    $emi = round($emi, 2);
    $total_payment = round($emi * $period_months, 2);
    $total_interest = round($total_payment - $loan_amount, 2);

    echo "<h2>EMI Calculation Result</h2>";
    echo "Loan Amount: ₹".$loan_amount."<br>";
    echo "Interest Rate: ".$interest_rate."%<br>";
    echo "Loan Period: ".$period_months." months<br>";
    echo "Start Date: ".$start_date."<br><br>";

    echo "<strong>Monthly EMI: ₹".$emi."</strong><br>";
    echo "Total Interest: ₹".$total_interest."<br>";
    echo "Total Payment (Principal + Interest): ₹".$total_payment."<br><br>";

    // কিস্তি শিডিউল
    echo "<h3>EMI Schedule:</h3>";
    echo "<table border='1' cellpadding='5'>
        <tr>
            <th>Installment No.</th>
            <th>Payment Date</th>
            <th>EMI Amount (₹)</th>
        </tr>";

    for($i=1; $i<=$period_months; $i++){
        $payment_date = date('Y-m-d', strtotime("+$i month", strtotime($start_date)));
        echo "<tr>
            <td>$i</td>
            <td>$payment_date</td>
            <td>$emi</td>
        </tr>";
    }

    echo "</table>";
}
else{
    echo "Invalid Access!";
}
?>
include '../../config/db.php';  // এটাকে ফাইলের শুরুতে রেখো

// Loan Details ডাটাবেজে Insert
$insertLoan = "INSERT INTO loans (loan_amount, interest_rate, period_months, start_date) 
               VALUES ('$loan_amount', '$interest_rate', '$period_months', '$start_date')";
if($conn->query($insertLoan)){
    $loan_id = $conn->insert_id;

    // EMI Schedule Insert
    for($i=1; $i<=$period_months; $i++){
        $payment_date = date('Y-m-d', strtotime("+$i month", strtotime($start_date)));
        $insertEMI = "INSERT INTO emi_schedule (loan_id, installment_no, payment_date, emi_amount)
                      VALUES ('$loan_id', '$i', '$payment_date', '$emi')";
        $conn->query($insertEMI);
    }

    echo "<p style='color:green;'>✅ EMI Schedule Successfully Saved to Database!</p>";

} else {
    echo "❌ Loan Insert Error: " . $conn->error;
}
