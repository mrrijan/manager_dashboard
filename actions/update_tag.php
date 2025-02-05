<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag_id = $_POST['tag_id'];
    $tag_name = $_POST['tag_name'];
    $tag_type = $_POST['tag_type'];

    $stmt = $conn->prepare("UPDATE `tags` SET tagName = ?, tagType = ? WHERE tagId = ?");
    $stmt->bind_param("ssi", $tag_name, $tag_type, $tag_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tag updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating tag: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/tags.php");
    exit();
}
?>
