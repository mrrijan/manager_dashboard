<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_id = $_POST['entry_id'];
    $title = $_POST['title'];
    $preview = $_POST['preview'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $section = $_POST['section'];

    $query = "UPDATE `knowledge entries` 
              SET `Post Title` = ?, `Post Preview` = ?, `Post Data` = ?, `Tags` = ?, `knowledge section` = ? 
              WHERE `Post ID` = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $title, $preview, $content, $tags, $section, $entry_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Knowledge entry updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating entry: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/knowledge.php");
    exit();
}
?>
