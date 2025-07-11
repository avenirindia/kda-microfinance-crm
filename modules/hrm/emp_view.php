<?php
include '../../config/db.php';
$conn = Database::connect();

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $result->fetch_assoc();
?>

<h2>Employee Details</h2>
<p><strong>Employee Code:</strong> <?php echo $data['emp_code']; ?></p>
<p><strong>Name:</strong> <?php echo $data['emp_name']; ?></p>
<p><strong>Mobile:</strong> <?php echo $data['mobile']; ?></p>
<p><strong>CTC:</strong> <?php echo $data['total_ctc']; ?></p>

<p><strong>Aadhaar File:</strong> <?php if($data['aadhar_file']) echo "<a href='".$data['aadhar_file']."' target='_blank'>View</a>"; ?></p>
<p><strong>PAN File:</strong> <?php if($data['pan_file']) echo "<a href='".$data['pan_file']."' target='_blank'>View</a>"; ?></p>

<p><a href="emp_list.php">Back to List</a></p>
