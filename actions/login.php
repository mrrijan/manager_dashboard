<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user details
    $query = "SELECT * FROM `Login Table` WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['hashed password'])) {
            $_SESSION['user_id'] = $user['User ID'];
            $_SESSION['email'] = $user['Email'];

            // Fetch first name from `users_info` table
            $userQuery = "SELECT first_name FROM users_info WHERE user_id = ?";
            $stmt2 = $conn->prepare($userQuery);
            $stmt2->bind_param("i", $user['User ID']);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $userData = $result2->fetch_assoc();

            // Store user name in session
            $_SESSION['user_name'] = $userData['first_name'];

            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
