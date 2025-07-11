<?php
include '../../../config/db.php';

if(isset($_POST['add'])){
    $branch  = $conn->real_escape_string($_POST['branch_name']);
    $address = $conn->real_escape_string($_POST['address']);

    $insert = "INSERT INTO branches(branch_name, address) VALUES('$branch', '$address')";

    if($conn->query($insert)){
        header("Location: list.php");
        exit;
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Branch</title>
</head>
<body>

<h2>Add New Branch</h2>

<form method="post" action="">
    <label>Branch Name:</label><br>
    <input type="text" name="branch_name" required><br><br>

    <label>Address:</label><br>
    <textarea name="address" required></textarea><br><br>

    <button type="submit" name="add">Add Branch</button>
</form>

</body>
</html>
