<?php
session_start();
include "../config/db.php";

if (isset($_GET['id'])) {
    $tag_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM `tags` WHERE tagId = ?");
    $stmt->bind_param("i", $tag_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tag deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting tag: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/tags.php");
    exit();
}
?>
