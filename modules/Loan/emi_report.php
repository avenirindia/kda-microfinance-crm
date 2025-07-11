<h3>Filter EMI Report</h3>
<form method="get">
    From: <input type="date" name="from_date">
    To: <input type="date" name="to_date">
    Loan ID: <input type="text" name="loan_id">
    <input type="submit" value="Search">
</form>
<br>

<h3>EMI Report</h3>

<table border="1">
<tr>
    <th>EMI Date</th>
    <th>Loan ID</th>
    <th>Amount</th>
</tr>

<?php
include 'dbconnect.php';

$where = "WHERE 1"; 

if(!empty($_GET['from_date'])){
    $where .= " AND emi_date >= '".$_GET['from_date']."'";
}
if(!empty($_GET['to_date'])){
    $where .= " AND emi_date <= '".$_GET['to_date']."'";
}
if(!empty($_GET['loan_id'])){
    $where .= " AND loan_id = '".$_GET['loan_id']."'";
}

$query = "SELECT * FROM emi_table $where";

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row['emi_date']."</td>";
    echo "<td>".$row['loan_id']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "</tr>";
}
?>
</table>
