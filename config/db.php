<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kda_microfinance_crm");

// Connection check
if($conn->connect_error){
    die("Database connection failed: " . $conn->connect_error);
}
?>
