<?php
include '../../../config/db.php';

$id = $_GET['id'];

// এমপ্লয়ির ইনফো আগে নিয়ে আসো যাতে ফাইল ডিলিট করা যায়
$get = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $get->fetch_assoc();

function deleteFile($filename){
    if($filename != '' && file_exists('../../../uploads/'.$filename)){
        unlink('../../../uploads/'.$filename);
    }
}

// Upload করা ফাইলগুলো ডিলিট
deleteFile($data['aadhaar_file']);
deleteFile($data['pan_file']);
deleteFile($data['bank_file']);
deleteFile($data['qualification_file']);
deleteFile($data['photo']);

// Employee ডিলিট
$conn->query("DELETE FROM employees WHERE id='$id'");

// ফেরত পাঠাও লিস্টে
header("Location: emp_list.php");
?>
