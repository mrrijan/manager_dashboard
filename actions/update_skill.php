<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_knowledge_id = $_POST['knowledge_id'];

    // Fetch the heading from knowledge_area based on the new knowledge_id
    $stmtHeading = $conn->prepare("SELECT Heading FROM `knowledge area` WHERE knowledge_id = ?");
    $stmtHeading->bind_param("i", $new_knowledge_id);
    $stmtHeading->execute();
    $stmtHeading->bind_result($new_heading);
    $stmtHeading->fetch();
    $stmtHeading->close();

    if (!$new_heading) {
        echo "<script>alert('Invalid knowledge ID!'); window.location.href='../pages/skills.php';</script>";
        exit();
    }

    // Update knowledge_id and heading in user_knowledge table
    $stmt = $conn->prepare("UPDATE `user_knowledge` SET knowledge_id = ?, heading = ? WHERE user_id = ?");
    $stmt->bind_param("isi", $new_knowledge_id, $new_heading, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Skill updated successfully!'); window.location.href='../pages/skills.php';</script>";
    } else {
        echo "<script>alert('Failed to update skill!'); window.location.href='../pages/skills.php';</script>";
    }
    $stmt->close();
}
?>
