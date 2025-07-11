<?php
include '../../../config/db.php';

$id = $_GET['id'];
$get = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $get->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
  <h3>Employee Details: <?= $data['emp_name'] ?></h3>
  <hr>

  <h5>Basic Info</h5>
  <p><strong>Mobile:</strong> <?= $data['mobile'] ?></p>
  <p><strong>Email:</strong> <?= $data['email'] ?></p>
  <p><strong>Address:</strong> <?= $data['address'] ?></p>

  <h5 class="mt-3">KYC Documents</h5>
  <ul>
    <?php if($data['aadhaar_file']) echo "<li><a href='../../../uploads/{$data['aadhaar_file']}' target='_blank'>Aadhaar</a></li>"; ?>
    <?php if($data['pan_file']) echo "<li><a href='../../../uploads/{$data['pan_file']}' target='_blank'>PAN</a></li>"; ?>
    <?php if($data['bank_file']) echo "<li><a href='../../../uploads/{$data['bank_file']}' target='_blank'>Bank Passbook</a></li>"; ?>
    <?php if($data['qualification_file']) echo "<li><a href='../../../uploads/{$data['qualification_file']}' target='_blank'>Qualification</a></li>"; ?>
    <?php if($data['photo']) echo "<li><a href='../../../uploads/{$data['photo']}' target='_blank'>Photo</a></li>"; ?>
  </ul>

  <h5 class="mt-3">CTC Breakup</h5>
  <table class="table table-bordered">
    <tr><th>Basic Salary</th><td>₹<?= $data['basic_salary'] ?></td></tr>
    <tr><th>HRA</th><td>₹<?= $data['hra'] ?></td></tr>
    <tr><th>Conveyance</th><td>₹<?= $data['conveyance'] ?></td></tr>
    <tr><th>Incentive</th><td>₹<?= $data['incentive'] ?></td></tr>
    <tr><th>Bonus</th><td>₹<?= $data['bonus'] ?></td></tr>
    <tr><th>Other Allowances</th><td>₹<?= $data['other_allowances'] ?></td></tr>
    <tr class="table-success"><th>Total Payment</th><td>₹<?= $data['total_payment'] ?></td></tr>
    <tr><th>ESI</th><td>₹<?= $data['esi'] ?></td></tr>
    <tr><th>PF</th><td>₹<?= $data['pf'] ?></td></tr>
    <tr><th>Dev Fee</th><td>₹<?= $data['dev_fee'] ?></td></tr>
    <tr><th>TDS</th><td>₹<?= $data['tds'] ?></td></tr>
    <tr><th>P.Tax</th><td>₹<?= $data['ptax'] ?></td></tr>
    <tr><th>Others Deduction</th><td>₹<?= $data['others_deduction'] ?></td></tr>
    <tr class="table-danger"><th>Total Deduction</th><td>₹<?= $data['total_deduction'] ?></td></tr>
    <tr class="table-warning"><th>Net Salary</th><td>₹<?= $data['net_salary'] ?></td></tr>
  </table>

  <h5 class="mt-3">Transfer Info</h5>
  <p><strong>From Branch:</strong> <?= $data['from_branch'] ?></p>
  <p><strong>To Branch:</strong> <?= $data['to_branch'] ?></p>
  <p><strong>Reason:</strong> <?= $data['transfer_reason'] ?></p>
  <p><strong>Date:</strong> <?= $data['transfer_date'] ?></p>

  <a href="emp_list.php" class="btn btn-secondary">Back to List</a>
</div>
