<?php
include "../config/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notification_id = $_POST['notification_id'];
    $text = $_POST['text'];
    $colour = $_POST['colour'];

    $query = "UPDATE `Notifications` SET `Notification Text` = ?, `Notification Colour` = ? WHERE `Notification ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $text, $colour, $notification_id);

    if ($stmt->execute()) {
        header("Location: ../pages/notifications.php?success=updated");
    } else {
        header("Location: ../pages/notifications.php?error=failed");
    }
}
?>
