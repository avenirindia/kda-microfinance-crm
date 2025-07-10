<?php
include '../../config/db.php';

if(isset($_POST['add_visit'])){
    $branch_id  = $_POST['branch_id'];
    $visit_date = $_POST['visit_date'];
    $place      = $_POST['place'];
    $lsp_name   = $_POST['lsp_name'];

    $year   = date("Y");
    $month  = date("m");

    $sql = "SELECT COUNT(*) as total FROM market_visits WHERE YEAR(visit_date) = '$year' AND MONTH(visit_date) = '$month'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $count = $row['total'];

    $serial   = str_pad($count+1, 4, "0", STR_PAD_LEFT);
    $ref_code = "NKS/$year/$month/$serial";

    $sql = "INSERT INTO market_visits (branch_id, visit_date, place, lsp_name, reference_code)
            VALUES ('$branch_id', '$visit_date', '$place', '$lsp_name', '$ref_code')";

    if($conn->query($sql) === TRUE){
        echo "<p style='color:green;'>✅ Market Visit Added Successfully! Ref Code: <b>$ref_code</b></p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . $conn->error . "</p>";
    }
}
?>

<!-- 📌 HTML Form -->
<h2>Add Market Visit</h2>
<form method="post">
    <label>Branch ID:</label>
    <input type="text" name="branch_id" required><br><br>

    <label>Visit Date:</label>
    <input type="date" name="visit_date" required><br><br>

    <label>Place:</label>
    <input type="text" name="place" required><br><br>

    <label>LSP Name:</label>
    <input type="text" name="lsp_name" required><br><br>

    <button type="submit" name="add_visit">✅ Save Visit</button>
</form>
