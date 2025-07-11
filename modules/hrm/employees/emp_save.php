<?php
include("../../config/db.php");

// ফাইল আপলোড ফাংশন
function uploadFile($fileField, $targetDir) {
    $fileName = basename($_FILES[$fileField]["name"]);
    $targetFile = $targetDir . time() . '_' . $fileName;
    move_uploaded_file($_FILES[$fileField]["tmp_name"], $targetFile);
    return $targetFile;
}

$photo = uploadFile('photo', '../../uploads/');
$aadhaar_file = uploadFile('aadhaar_file', '../../uploads/');
$pan_file = uploadFile('pan_file', '../../uploads/');
$bank_doc = uploadFile('bank_doc', '../../uploads/');
$qualification_cert = uploadFile('qualification_cert', '../../uploads/');
$signature = uploadFile('signature', '../../uploads/');

$sql = "INSERT INTO emp_applications 
(name, father_name, dob, mobile, whatsapp, home_contact, email, permanent_address, present_address, aadhaar_no, pan_no, voter_id, bank_name, account_no, ifsc_code, branch_name, account_type, nominee_name, nominee_dob, relation, last_agency, joining_date, occupation, qualification, employment_branch, photo, aadhaar_file, pan_file, bank_doc, qualification_cert, signature) 
VALUES 
(
'{$_POST['name']}', '{$_POST['father_name']}', '{$_POST['dob']}', '{$_POST['mobile']}', '{$_POST['whatsapp']}', '{$_POST['home_contact']}', '{$_POST['email']}',
'{$_POST['permanent_address']}', '{$_POST['present_address']}', '{$_POST['aadhaar_no']}', '{$_POST['pan_no']}', '{$_POST['voter_id']}',
'{$_POST['bank_name']}', '{$_POST['account_no']}', '{$_POST['ifsc_code']}', '{$_POST['branch_name']}', '{$_POST['account_type']}',
'{$_POST['nominee_name']}', '{$_POST['nominee_dob']}', '{$_POST['relation']}', '{$_POST['last_agency']}', '{$_POST['joining_date']}',
'{$_POST['occupation']}', '{$_POST['qualification']}', '{$_POST['employment_branch']}', 
'$photo', '$aadhaar_file', '$pan_file', '$bank_doc', '$qualification_cert', '$signature'
)";

if ($conn->query($sql) === TRUE) {
    echo "Application submitted successfully. <a href='emp_application_list.php'>View Applications</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
