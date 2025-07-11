<?php
include('../../config/db_connect.php');

$emp_name = $_POST['emp_name'] ?? '';
$father_name = $_POST['father_name'] ?? '';
$dob = $_POST['dob'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$state = $_POST['state'] ?? '';
$district = $_POST['district'] ?? '';
$branch_name = $_POST['branch_name'] ?? '';
$designation = $_POST['designation'] ?? '';
$joining_date = $_POST['joining_date'] ?? '';
$basic = $_POST['basic'] ?? 0;
$hra = $_POST['hra'] ?? 0;
$allowances = $_POST['allowances'] ?? 0;
$esi = $_POST['esi'] ?? 0;
$pf = $_POST['pf'] ?? 0;
$dev_fee = $_POST['dev_fee'] ?? 0;
$other_deduction = $_POST['other_deduction'] ?? 0;

// Check duplicate by emp_name + mobile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $check_sql = "SELECT * FROM employees WHERE emp_name='$emp_name' AND mobile='$mobile'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<div class='alert alert-danger'>Employee with same name and mobile already exists!</div>";
    } else {
        // File Upload Handling
        $aadhaar = $_FILES['aadhaar']['name'];
        $pan = $_FILES['pan']['name'];
        $bank = $_FILES['bank']['name'];
        $qualification = $_FILES['qualification']['name'];
        $photo = $_FILES['photo']['name'];

        $target_dir = "uploads/";
        move_uploaded_file($_FILES["aadhaar"]["tmp_name"], $target_dir.$aadhaar);
        move_uploaded_file($_FILES["pan"]["tmp_name"], $target_dir.$pan);
        move_uploaded_file($_FILES["bank"]["tmp_name"], $target_dir.$bank);
        move_uploaded_file($_FILES["qualification"]["tmp_name"], $target_dir.$qualification);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir.$photo);

        // Insert Employee Data
        $sql = "INSERT INTO employees (emp_name, father_name, dob, mobile, email, address, state, district, branch_name, designation, joining_date, aadhaar, pan, bank, qualification, photo, basic, hra, allowances, esi, pf, dev_fee, other_deduction)
        VALUES ('$emp_name','$father_name','$dob','$mobile','$email','$address','$state','$district','$branch_name','$designation','$joining_date','$aadhaar','$pan','$bank','$qualification','$photo','$basic','$hra','$allowances','$esi','$pf','$dev_fee','$other_deduction')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Employee Added Successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-4">
    <h3 class="mb-4">Add New Employee</h3>
    <form method="POST" enctype="multipart/form-data">

        <div class="row g-3">
            <div class="col-md-6">
                <label>Employee Name</label>
                <input type="text" name="emp_name" class="form-control" value="<?= $emp_name ?>" required>
            </div>
            <div class="col-md-6">
                <label>Father's Name</label>
                <input type="text" name="father_name" class="form-control" value="<?= $father_name ?>">
            </div>
            <div class="col-md-4">
                <label>DOB</label>
                <input type="date" name="dob" class="form-control" value="<?= $dob ?>">
            </div>
            <div class="col-md-4">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" value="<?= $mobile ?>" required>
            </div>
            <div class="col-md-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $email ?>">
            </div>
            <div class="col-12">
                <label>Address</label>
                <textarea name="address" class="form-control"><?= $address ?></textarea>
            </div>
            <div class="col-md-4">
                <label>State</label>
                <input type="text" name="state" class="form-control" value="<?= $state ?>">
            </div>
            <div class="col-md-4">
                <label>District</label>
                <input type="text" name="district" class="form-control" value="<?= $district ?>">
            </div>
            <div class="col-md-4">
                <label>Branch Name</label>
                <input type="text" name="branch_name" class="form-control" value="<?= $branch_name ?>">
            </div>
            <div class="col-md-6">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" value="<?= $designation ?>">
            </div>
            <div class="col-md-6">
                <label>Joining Date</label>
                <input type="date" name="joining_date" class="form-control" value="<?= $joining_date ?>">
            </div>

            <h5 class="mt-4">CTC Breakup</h5>
            <div class="col-md-4">
                <label>Basic</label>
                <input type="number" name="basic" class="form-control" value="<?= $basic ?>">
            </div>
            <div class="col-md-4">
                <label>HRA</label>
                <input type="number" name="hra" class="form-control" value="<?= $hra ?>">
            </div>
            <div class="col-md-4">
                <label>Allowances</label>
                <input type="number" name="allowances" class="form-control" value="<?= $allowances ?>">
            </div>
            <div class="col-md-3">
                <label>ESI</label>
                <input type="number" name="esi" class="form-control" value="<?= $esi ?>">
            </div>
            <div class="col-md-3">
                <label>PF</label>
                <input type="number" name="pf" class="form-control" value="<?= $pf ?>">
            </div>
            <div class="col-md-3">
                <label>Dev Fee (%)</label>
                <input type="number" name="dev_fee" class="form-control" value="<?= $dev_fee ?>">
            </div>
            <div class="col-md-3">
                <label>Other Deduction</label>
                <input type="number" name="other_deduction" class="form-control" value="<?= $other_deduction ?>">
            </div>

            <h5 class="mt-4">Upload Documents</h5>
            <div class="col-md-4">
                <label>Aadhaar</label>
                <input type="file" name="aadhaar" class="form-control">
            </div>
            <div class="col-md-4">
                <label>PAN</label>
                <input type="file" name="pan" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Bank Passbook</label>
                <input type="file" name="bank" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Qualification Certificate</label>
                <input type="file" name="qualification" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Add Employee</button>
            </div>
        </div>
    </form>
</body>
</html>
