<?php
include "config/db.php";

// Define user details
$email = "admin@make-it-all.com";
$user_id = 3;  // Use a valid user_id from user_knowledge
$password = "password"; // Plain text password

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
// Insert into login table
$query = "INSERT INTO `login table` (email, `User ID`, `hashed password`) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sis", $email, $user_id, $hashed_password);

if ($stmt->execute()) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>
