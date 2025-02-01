<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];

    $query = "INSERT INTO users_info (email, first_name, last_name, contact_number, status) VALUES (?, ?, ?, ?, 'Active')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $email, $first_name, $last_name, $contact_number);

    if ($stmt->execute()) {
        echo "<script>alert('User added successfully!'); window.location.href='../pages/users.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
