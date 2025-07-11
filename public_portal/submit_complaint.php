<?php
include '../config/db.php';

if(isset($_POST['submit'])){
    $emp_code = $_POST['emp_code'];
    $type = $_POST['type'];
    $text = $_POST['text'];

    $emp = $conn->query("SELECT id FROM employees WHERE emp_code='$emp_code'")->fetch_assoc();

    if($emp){
        $emp_id = $emp['id'];
        $conn->query("INSERT INTO employee_complaints (emp_id, complaint_type, complaint_text) VALUES ('$emp_id', '$type', '$text')");
        echo "<h3>✅ Complaint Submitted</h3>";
    } else {
        echo "<h3>❌ Employee Not Found</h3>";
    }
}
?>

<form method="post">
    <input type="text" name="emp_code" placeholder="Employee Code" required><br>
    <input type="text" name="type" placeholder="Complaint Type" required><br>
    <textarea name="text" placeholder="Complaint Text" required></textarea><br>
    <button type="submit" name="submit">Submit</button>
</form>
