<?php
include '../../../config/db.php';

// ডাটা নাও
$emp_name = $_POST['emp_name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$address = $_POST['address'];

// CTC Breakup
$basic_salary = $_POST['basic_salary'];
$hra = $_POST['hra'];
$conveyance = $_POST['conveyance'];
$incentive = $_POST['incentive'];
$bonus = $_POST['bonus'];
$other_allowances = $_POST['other_allowances'];
$total_payment = $_POST['total_payment'];
$esi = $_POST['esi'];
$pf = $_POST['pf'];
$dev_fee = $_POST['dev_fee'];
$tds = $_POST['tds'];
$ptax = $_POST['ptax'];
$others_deduction = $_POST['others_deduction'];
$total_deduction = $_POST['total_deduction'];
$net_salary = $_POST['net_salary'];

// Transfer info
$from_branch = $_POST['from_branch'];
$to_branch = $_POST['to_branch'];
$transfer_reason = $_POST['transfer_reason'];
$transfer_date = $_POST['transfer_date'];

// Duplicate Check
$check = $conn->query("SELECT * FROM employees WHERE emp_name='$emp_name' AND mobile='$mobile'");
if($check->num_rows > 0){
    echo "<div class='alert alert-danger'>❌ এই এমপ্লয়ি আগেই আছে!</div>";
    exit;
}

// File Upload function
function uploadFile($fileInput){
    if($_FILES[$fileInput]['name'] != ''){
        $filename = time().'_'.$_FILES[$fileInput]['name'];
        move_uploaded_file($_FILES[$fileInput]['tmp_name'], '../../../uploads/'.$filename);
        return $filename;
    }
    return '';
}

// Files
$aadhaar_file = uploadFile('aadhaar_file');
$pan_file = uploadFile('pan_file');
$bank_file = uploadFile('bank_file');
$qualification_file = uploadFile('qualification_file');
$photo = uploadFile('photo');

// Insert Query
$insert = "INSERT INTO employees(emp_name, mobile, email, address, 
aadhaar_file, pan_file, bank_file, qualification_file, photo,
basic_salary, hra, conveyance, incentive, bonus, other_allowances, total_payment,
esi, pf, dev_fee, tds, ptax, others_deduction, total_deduction, net_salary,
from_branch, to_branch, transfer_reason, transfer_date)
VALUES('$emp_name', '$mobile', '$email', '$address', 
'$aadhaar_file', '$pan_file', '$bank_file', '$qualification_file', '$photo',
'$basic_salary', '$hra', '$conveyance', '$incentive', '$bonus', '$other_allowances', '$total_payment',
'$esi', '$pf', '$dev_fee', '$tds', '$ptax', '$others_deduction', '$total_deduction', '$net_salary',
'$from_branch', '$to_branch', '$transfer_reason', '$transfer_date')";

// Query Run
if($conn->query($insert)){
    echo "<div class='alert alert-success'>✅ এমপ্লয়ি সফলভাবে এড হয়েছে!</div>";
    echo "<a href='emp_list.php' class='btn btn-primary'>📋 Employee List</a>";
} else {
    echo "<div class='alert alert-danger'>❌ Error: ".$conn->error."</div>";
}
?>
