<?php
$host = "localhost"; // Change to your DB host
$user = "root"; // Change if necessary
$password = ""; // Change if necessary
$database = "team020"; 

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
