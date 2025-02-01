<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $preview = $_POST['preview'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $section = $_POST['section'];

    $query = "INSERT INTO `knowledge entries` (`Author`, `Post Title`, `Post Preview`, `Post Data`, `Tags`, `knowledge section`, `Creation Date`) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssss", $author_id, $title, $preview, $content, $tags, $section);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Knowledge entry added successfully!";
    } else {
        $_SESSION['error'] = "Error adding entry: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/knowledge.php");
    exit();
}
?>
