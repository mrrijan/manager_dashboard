<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $preview = $_POST['preview'];
    $content = $_POST['content'];
    $tag_id = $_POST['tag_id'];

    // Fetch the tagType (Technical or Non-Technical) based on the selected tagId
    $stmtTag = $conn->prepare("SELECT tagType FROM `tags` WHERE tagId = ?");
    $stmtTag->bind_param("i", $tag_id);
    $stmtTag->execute();
    $stmtTag->bind_result($knowledge_section);
    $stmtTag->fetch();
    $stmtTag->close();

    // Ensure the knowledge section is not empty
    if (!$knowledge_section) {
        $_SESSION['error'] = "Error: Unable to determine knowledge section!";
        header("Location: ../pages/knowledge.php");
        exit();
    }
    echo $knowledge_section;
    // Insert the new knowledge entry with the correct tagId and knowledge section
    $query = "INSERT INTO `knowledge entries` (`Author`, `Post Title`, `Post Preview`, `Post Data`, `tagId`, `knowledge section`, `Creation Date`) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssis", $author_id, $title, $preview, $content, $tag_id, $knowledge_section);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Knowledge entry added successfully!";
    } else {
        $_SESSION['error'] = "Error adding entry: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/knowledge.php");
    exit();
}
