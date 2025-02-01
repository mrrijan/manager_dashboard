<?php
include "../config/db.php";
session_start();

if (isset($_GET['id'])) {
    $notification_id = $_GET['id'];

    $query = "DELETE FROM `Notifications` WHERE `Notification ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $notification_id);

    if ($stmt->execute()) {
        header("Location: ../pages/notifications.php?success=deleted");
    } else {
        header("Location: ../pages/notifications.php?error=failed");
    }
}
?>
