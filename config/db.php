<?php
$conn = new mysqli("localhost", "root", "", "kda_microfinance_crm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
