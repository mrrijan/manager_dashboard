<?php
include "../config/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $text = $_POST['text'];
    $colour = $_POST['colour'];

    $query = "INSERT INTO `Notifications` (`User ID`, `Notification Text`, `Notification Colour`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $text, $colour);

    if ($stmt->execute()) {
        header("Location: ../pages/notifications.php?success=added");
    } else {
        header("Location: ../pages/notifications.php?error=failed");
    }
}
?>
