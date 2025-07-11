<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid Access!');
}

// ডাটাবেজ কানেকশন
$conn = Database::connect();

// Form Data
$emp_code       = $_POST['emp_code'];
$emp_name       = $_POST['emp_name'];
$father_name    = $_POST['father_name'];
$address        = $_POST['address'];
$email          = $_POST['email'];
$mobile         = $_POST['mobile'];
$home_contact   = $_POST['home_contact'];
$aadhar_no      = $_POST['aadhar_no'];
$pan_no         = $_POST['pan_no'];
$qualification  = $_POST['qualification'];
$bank_details   = $_POST['bank_details'];

// CTC Breakup Data
$basic_salary       = $_POST['basic_salary'];
$hra                = $_POST['hra'];
$medical            = $_POST['medical'];
$travel             = $_POST['travel'];
$special            = $_POST['special'];
$pf                 = $_POST['pf'];
$esi                = $_POST['esi'];
$prof_tax           = $_POST['prof_tax'];
$company_dev_fee    = $_POST['company_dev_fee'];
$free_deduction     = $_POST['free_deduction'];

$total_ctc = $basic_salary + $hra + $medical + $travel + $special + $pf + $esi + $prof_tax + $company_dev_fee - $free_deduction;

// ফাইল আপলোড ডিরেক্টরি
$upload_dir = "../../uploads/employees/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Upload Files
function uploadFile($fileInput, $upload_dir) {
    if (!empty($_FILES[$fileInput]['name'])) {
        $fileName = uniqid() . "_" . $_FILES[$fileInput]['name'];
        $destination = $upload_dir . $fileName;
        move_uploaded_file($_FILES[$fileInput]['tmp_name'], $destination);
        return $destination;
    }
    return "";
}

$aadhar_file        = uploadFile('aadhar_file', $upload_dir);
$pan_file           = uploadFile('pan_file', $upload_dir);
$qualification_file = uploadFile('qualification_file', $upload_dir);
$bank_proof_file    = uploadFile('bank_proof_file', $upload_dir);

// Insert Query
$insertEmp = "INSERT INTO employees 
(emp_code, emp_name, father_name, address, email, mobile, home_contact, aadhar_no, pan_no, qualification, bank_details,
basic_salary, hra, medical, travel, special, pf, esi, prof_tax, company_dev_fee, free_deduction, total_ctc, 
aadhar_file, pan_file, qualification_file, bank_proof_file)
VALUES 
('$emp_code', '$emp_name', '$father_name', '$address', '$email', '$mobile', '$home_contact', '$aadhar_no', '$pan_no', 
'$qualification', '$bank_details', '$basic_salary', '$hra', '$medical', '$travel', '$special', '$pf', '$esi', '$prof_tax', 
'$company_dev_fee', '$free_deduction', '$total_ctc', 
'$aadhar_file', '$pan_file', '$qualification_file', '$bank_proof_file')";

if ($conn->query($insertEmp)) {
    echo "<h3 style='color:green;'>✅ Employee Added Successfully!</h3>";
    echo "<a href='emp_add.php'>Add Another</a>";
} else {
    echo "❌ Employee Insert Error: " . $conn->error;
}
?>
