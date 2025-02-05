<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag_name = $_POST['tag_name'];
    $tag_type = $_POST['tag_type'];

    $stmt = $conn->prepare("INSERT INTO `tags` (tagName, tagType) VALUES (?, ?)");
    $stmt->bind_param("ss", $tag_name, $tag_type);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tag added successfully!";
    } else {
        $_SESSION['error'] = "Error adding tag: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/tags.php");
    exit();
}
?>
