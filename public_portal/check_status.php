<?php
include '../config/db.php';
$conn = Database::connect();

if(isset($_POST['emp_code'])){
    $emp_code = $_POST['emp_code'];

    $empResult = $conn->query("SELECT id, emp_name, current_designation FROM employees WHERE emp_code='$emp_code'");
    if($empResult->num_rows > 0){
        $emp = $empResult->fetch_assoc();
        $emp_id = $emp['id'];

        // Resignation Status Check
        $res = $conn->query("SELECT * FROM resignations WHERE emp_id='$emp_id'");
        if($res->num_rows > 0){
            $resData = $res->fetch_assoc();
            echo "<h3>Status for ".$emp['emp_name']." (".$emp_code.")</h3>";
            echo "<p>Designation: ".$emp['current_designation']."</p>";
            echo "<p>Resignation Status: ".$resData['status']."</p>";

            if($resData['status']=='Relieved' && $resData['relieving_letter_path'] != ""){
                echo "<p><a href='".$resData['relieving_letter_path']."' target='_blank'>📥 Download Relieving Letter</a></p>";
            } else {
                echo "<p>Relieving Letter Not Ready Yet.</p>";
            }
        } else {
            echo "<p>No Resignation Record Found.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid Employee Code.</p>";
    }
}
?>

<h2>Check Resignation Status</h2>
<form method="POST">
    Enter Employee Code: <input type="text" name="emp_code" required>
    <input type="submit" value="Check">
</form>
