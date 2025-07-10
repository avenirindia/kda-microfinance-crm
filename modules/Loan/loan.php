<h2>Add Loan Details</h2>

<form method="post" action="../loan/emi_calculation.php">
    <label>Loan Amount:</label>
    <input type="number" name="loan_amount" required><br><br>

    <label>Interest Rate (per annum %):</label>
    <input type="number" step="0.01" name="interest_rate" required><br><br>

    <label>Loan Period (in months):</label>
    <input type="number" name="period_months" required><br><br>

    <label>Start Date:</label>
    <input type="date" name="start_date" required><br><br>

    <button type="submit" name="calculate">Calculate EMI</button>
</form>
