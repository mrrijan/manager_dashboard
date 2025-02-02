<?php
include "../config/db.php";

if (isset($_GET['user_id']) && isset($_GET['knowledge_id'])) {
    $user_id = $_GET['user_id'];
    $knowledge_id = $_GET['knowledge_id'];

    // Delete only the selected skill
    $stmt = $conn->prepare("DELETE FROM `user_knowledge` WHERE user_id = ? AND knowledge_id = ?");
    $stmt->bind_param("ii", $user_id, $knowledge_id);

    if ($stmt->execute()) {
        echo "<script>alert('Skill deleted successfully!'); window.location.href='../pages/skills.php';</script>";
    } else {
        echo "<script>alert('Failed to delete skill!'); window.location.href='../pages/skills.php';</script>";
    }
    $stmt->close();
}
?>
