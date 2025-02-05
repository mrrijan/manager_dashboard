<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_id = $_POST['entry_id'];
    $title = $_POST['title'];
    $preview = $_POST['preview'];
    $content = $_POST['content'];
    $tag_id = $_POST['tag_id']; // Tag ID selected in the form

    // Step 1: Fetch the correct tagType (Technical / Non-Technical) from tags table
    $stmtTag = $conn->prepare("SELECT tagType FROM `tags` WHERE tagId = ?");
    $stmtTag->bind_param("i", $tag_id);
    $stmtTag->execute();
    $stmtTag->bind_result($section);
    $stmtTag->fetch();
    $stmtTag->close();

    // Step 2: Ensure that the tagType exists before updating
    if (!$section) {
        $_SESSION['error'] = "Error: Invalid tag selection!";
        header("Location: ../pages/knowledge.php");
        exit();
    }

    // Step 3: Update the Knowledge Entry
    $query = "UPDATE `Knowledge Entries` 
              SET `Post Title` = ?, `Post Preview` = ?, `Post Data` = ?, `tagId` = ?, `knowledge section` = ?
              WHERE `Post ID` = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssisi", $title, $preview, $content, $tag_id, $section, $entry_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Knowledge entry updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating entry: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to knowledge page
    header("Location: ../pages/knowledge.php");
    exit();
}
?>
