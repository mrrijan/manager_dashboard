<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];

    $query = "UPDATE users_info SET email = ?, first_name = ?, last_name = ?, contact_number = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $email, $first_name, $last_name, $contact_number, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href='../pages/users.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
