<?php
include '../../../config/db.php';

$id = $_GET['id'];

// এমপ্লয়ির ডেটা লোড
$get = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $get->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
  <h2>Edit Employee</h2>
  <form method="post">

    <!-- Basic Info -->
    <div class="mb-2"><label>Name:</label><input type="text" name="emp_name" class="form-control" value="<?= $data['emp_name'] ?>" required></div>
    <div class="mb-2"><label>Mobile:</label><input type="text" name="mobile" class="form-control" value="<?= $data['mobile'] ?>" required></div>
    <div class="mb-2"><label>Email:</label><input type="email" name="email" class="form-control" value="<?= $data['email'] ?>"></div>
    <div class="mb-2"><label>Address:</label><textarea name="address" class="form-control"><?= $data['address'] ?></textarea></div>

    <!-- CTC Breakup -->
    <h5 class="mt-3">CTC Breakup</h5>
    <div class="row">
      <div class="col-md-6">
        <div class="mb-2"><label>Basic Salary:</label><input type="number" name="basic_salary" class="form-control" value="<?= $data['basic_salary'] ?>"></div>
        <div class="mb-2"><label>HRA:</label><input type="number" name="hra" class="form-control" value="<?= $data['hra'] ?>"></div>
        <div class="mb-2"><label>Conveyance:</label><input type="number" name="conveyance" class="form-control" value="<?= $data['conveyance'] ?>"></div>
        <div class="mb-2"><label>Incentive:</label><input type="number" name="incentive" class="form-control" value="<?= $data['incentive'] ?>"></div>
      </div>
      <div class="col-md-6">
        <div class="mb-2"><label>Bonus:</label><input type="number" name="bonus" class="form-control" value="<?= $data['bonus'] ?>"></div>
        <div class="mb-2"><label>Other Allowances:</label><input type="number" name="other_allowances" class="form-control" value="<?= $data['other_allowances'] ?>"></div>
        <div class="mb-2"><label>Net Salary:</label><input type="number" name="net_salary" class="form-control" value="<?= $data['net_salary'] ?>"></div>
      </div>
    </div>

    <!-- Transfer Info -->
    <h5 class="mt-3">Transfer Info</h5>
    <div class="mb-2"><label>From Branch:</label><input type="text" name="from_branch" class="form-control" value="<?= $data['from_branch'] ?>"></div>
    <div class="mb-2"><label>To Branch:</label><input type="text" name="to_branch" class="form-control" value="<?= $data['to_branch'] ?>"></div>
    <div class="mb-2"><label>Reason:</label><input type="text" name="transfer_reason" class="form-control" value="<?= $data['transfer_reason'] ?>"></div>
    <div class="mb-2"><label>Date:</label><input type="date" name="transfer_date" class="form-control" value="<?= $data['transfer_date'] ?>"></div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="emp_list.php" class="btn btn-secondary">Back</a>
  </form>
</div>

<?php
// ডেটা আপডেট
if(isset($_POST['update'])){
  $emp_name = $_POST['emp_name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $basic_salary = $_POST['basic_salary'];
  $hra = $_POST['hra'];
  $conveyance = $_POST['conveyance'];
  $incentive = $_POST['incentive'];
  $bonus = $_POST['bonus'];
  $other_allowances = $_POST['other_allowances'];
  $net_salary = $_POST['net_salary'];
  $from_branch = $_POST['from_branch'];
  $to_branch = $_POST['to_branch'];
  $transfer_reason = $_POST['transfer_reason'];
  $transfer_date = $_POST['transfer_date'];

  $update = "UPDATE employees SET 
    emp_name='$emp_name', mobile='$mobile', email='$email', address='$address',
    basic_salary='$basic_salary', hra='$hra', conveyance='$conveyance',
    incentive='$incentive', bonus='$bonus', other_allowances='$other_allowances', net_salary='$net_salary',
    from_branch='$from_branch', to_branch='$to_branch', transfer_reason='$transfer_reason', transfer_date='$transfer_date'
    WHERE id='$id'";

  if($conn->query($update)){
    echo "<script>alert('✅ Updated Successfully'); window.location='emp_list.php';</script>";
  } else {
    echo "<div class='alert alert-danger'>Error: ".$conn->error."</div>";
  }
}
?>
<script>
function calculateCTC() {
  let b = parseFloat(document.getElementById('basic_salary').value) || 0;
  let h = parseFloat(document.getElementById('hra').value) || 0;
  let c = parseFloat(document.getElementById('conveyance').value) || 0;
  let i = parseFloat(document.getElementById('incentive').value) || 0;
  let bo = parseFloat(document.getElementById('bonus').value) || 0;
  let o = parseFloat(document.getElementById('other_allowances').value) || 0;

  let e = parseFloat(document.getElementById('esi').value) || 0;
  let p = parseFloat(document.getElementById('pf').value) || 0;
  let d = parseFloat(document.getElementById('dev_fee').value) || 0;
  let t = parseFloat(document.getElementById('tds').value) || 0;
  let pt = parseFloat(document.getElementById('ptax').value) || 0;
  let ot = parseFloat(document.getElementById('others_deduction').value) || 0;

  let totalPayment = b + h + c + i + bo + o;
  let totalDeduction = e + p + d + t + pt + ot;
  let netSalary = totalPayment - totalDeduction;

  document.getElementById('total_payment').value = totalPayment.toFixed(2);
  document.getElementById('total_deduction').value = totalDeduction.toFixed(2);
  document.getElementById('net_salary').value = netSalary.toFixed(2);
}

document.querySelectorAll('input[type=number]').forEach(input => {
  input.addEventListener('input', calculateCTC);
});
</script>
