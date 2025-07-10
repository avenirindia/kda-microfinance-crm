<?php
$host = "sql301.freemysqlhosting.net";
$user = "your_db_user";
$pass = "your_password";
$db   = "your_db_name";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
