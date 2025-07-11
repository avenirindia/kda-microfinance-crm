<?php
include '../../config/db.php';

// Auto Employee Code Generate
$result = $conn->query("SELECT MAX(id) AS last_id FROM employees");
$row = $result->fetch_assoc();
$next_id = $row['last_id'] + 1;
$emp_code = "EMP" . str_pad($next_id, 4, '0', STR_PAD_LEFT);
?>

<h2>Add New Employee</h2>

<form action="emp_add_save.php" method="POST" enctype="multipart/form-data">
  <h3>Personal Details</h3>
  Employee Code: <input type="text" name="emp_code" value="<?php echo $emp_code; ?>" readonly><br><br>
  Employee Name: <input type="text" name="emp_name" required><br><br>
  Father's Name: <input type="text" name="father_name" required><br><br>
  Address: <input type="text" name="address" required><br><br>
  Email ID: <input type="email" name="email"><br><br>
  Mobile Number: <input type="text" name="mobile" required><br><br>
  Home Contact Number: <input type="text" name="home_contact"><br><br>

  <h3>Official / Bank Details</h3>
  Aadhaar Number: <input type="text" name="aadhar_no"><br><br>
  PAN Number: <input type="text" name="pan_no"><br><br>
  Qualification: <input type="text" name="qualification"><br><br>
  Bank Details: <input type="text" name="bank_details"><br><br>

  <h3>Upload Documents</h3>
  Aadhaar Card: <input type="file" name="aadhar_file"><br><br>
  PAN Card: <input type="file" name="pan_file"><br><br>
  Qualification Certificate: <input type="file" name="qualification_file"><br><br>
  Bank Proof: <input type="file" name="bank_proof_file"><br><br>

  <h3>CTC Breakup</h3>
  Basic Salary: <input type="number" name="basic_salary" value="0" required><br><br>
  HRA: <input type="number" name="hra" value="0"><br><br>
  Medical Allowance: <input type="number" name="medical" value="0"><br><br>
  Travel Allowance: <input type="number" name="travel" value="0"><br><br>
  Special Allowance: <input type="number" name="special" value="0"><br><br>
  Provident Fund (PF): <input type="number" name="pf" value="0"><br><br>
  ESI: <input type="number" name="esi" value="0"><br><br>
  Professional Tax: <input type="number" name="prof_tax" value="0"><br><br>
  Company Development Fee: <input type="number" name="company_dev_fee" value="0"><br><br>
  Free Deduction: <input type="number" name="free_deduction" value="0"><br><br>

  <input type="submit" value="Save Employee">
</form>
