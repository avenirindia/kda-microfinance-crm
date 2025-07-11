<?php
include '../config/db.php';
$conn = Database::connect();

if(isset($_POST['emp_code'])){
    $emp_code = $_POST['emp_code'];

    $empResult = $conn->query("SELECT id, emp_name FROM employees WHERE emp_code='$emp_code'");
    if($empResult->num_rows > 0){
        $emp = $empResult->fetch_assoc();
        $emp_id = $emp['id'];

        $complaints = $conn->query("SELECT * FROM employee_complaints WHERE emp_id='$emp_id' ORDER BY id DESC");
        echo "<h3>Complaints for ".$emp['emp_name']." (".$emp_code.")</h3>";
        if($complaints->num_rows > 0){
            while($row = $complaints->fetch_assoc()){
                echo "<p><strong>".$row['complaint_type']."</strong>: ".$row['complaint_text']." <br> Status: ".$row['status']."</p>";
                echo "<hr>";
            }
        } else {
            echo "<p>No Complaints Found.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid Employee Code.</p>";
    }
}
?>

<h2>Check Complaint Status</h2>
<form method="POST">
    Enter Employee Code: <input type="text" name="emp_code" required>
    <input type="submit" value="Check">
</form>
