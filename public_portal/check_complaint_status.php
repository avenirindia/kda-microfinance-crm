<?php
include '../config/db.php';  // শুধু এইটা থাকবে
?>
<?php
include '../config/db.php';

if(isset($_POST['check'])){
    $emp_code = $_POST['emp_code'];

    $emp = $conn->query("SELECT id FROM employees WHERE emp_code='$emp_code'")->fetch_assoc();

    if($emp){
        $emp_id = $emp['id'];
        $res = $conn->query("SELECT * FROM employee_complaints WHERE emp_id='$emp_id'");

        echo "<h2>Your Complaints</h2>";
        while($row = $res->fetch_assoc()){
            echo "<p>".$row['complaint_type']." : ".$row['complaint_text']." → Status: ".$row['status']."</p>";
        }
    } else {
        echo "<h3>❌ Employee Not Found</h3>";
    }
}
?>

<form method="post">
    <input type="text" name="emp_code" placeholder="Employee Code" required><br>
    <button type="submit" name="check">Check Status</button>
</form>
