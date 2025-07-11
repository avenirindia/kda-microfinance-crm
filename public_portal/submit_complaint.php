<?php
include '../config/db.php';

if(isset($_POST['emp_code'])){
    $emp_code       = $_POST['emp_code'];
    $complaint_type = $_POST['complaint_type'];
    $complaint_text = $_POST['complaint_text'];

    $empResult = $conn->query("SELECT id FROM employees WHERE emp_code='$emp_code'");
    if($empResult->num_rows > 0){
        $emp = $empResult->fetch_assoc();
        $emp_id = $emp['id'];

        $conn->query("INSERT INTO employee_complaints (emp_id, complaint_type, complaint_text) 
                      VALUES ('$emp_id', '$complaint_type', '$complaint_text')");
        echo "<p style='color:green;'>✅ Complaint Submitted Successfully!</p>";
    } else {
        echo "<p style='color:red;'>Invalid Employee Code.</p>";
    }
}
?>

<h2>Submit Complaint</h2>
<form method="POST">
    Employee Code: <input type="text" name="emp_code" required><br><br>
    Type:
    <select name="complaint_type" required>
        <option value="">--Select--</option>
        <option value="Resignation">Resignation</option>
        <option value="Relieving Letter">Relieving Letter</option>
        <option value="Salary">Salary</option>
        <option value="Other">Other</option>
    </select><br><br>
    Complaint:<br>
    <textarea name="complaint_text" rows="4" cols="40" required></textarea><br><br>
    <input type="submit" value="Submit Complaint">
</form>
