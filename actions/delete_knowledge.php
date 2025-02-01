<?php
session_start();
include "../config/db.php";

if (isset($_GET['id'])) {
    $entry_id = $_GET['id'];

    $query = "DELETE FROM `knowledge entries` WHERE `Post ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $entry_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Knowledge entry deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting entry: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/knowledge.php");
    exit();
}
?>
