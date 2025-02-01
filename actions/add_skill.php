<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $knowledge_id = $_POST['knowledge_id'];

    // Check if the user already has a skill assigned
    $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM `user_knowledge` WHERE user_id = ?");
    $stmtCheck->bind_param("i", $user_id);
    $stmtCheck->execute();
    $stmtCheck->bind_result($existingSkillCount);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($existingSkillCount > 0) {
        echo "<script>alert('User already has a skill!'); window.location.href='../pages/skills.php';</script>";
        exit();
    }

    // Fetch heading from knowledge_area
    $stmtHeading = $conn->prepare("SELECT Heading FROM `knowledge area` WHERE knowledge_id = ?");
    $stmtHeading->bind_param("i", $knowledge_id);
    $stmtHeading->execute();
    $stmtHeading->bind_result($heading);
    $stmtHeading->fetch();
    $stmtHeading->close();

    if (!$heading) {
        echo "<script>alert('Invalid knowledge ID!'); window.location.href='../pages/skills.php';</script>";
        exit();
    }

    // Insert the new skill along with heading
    $stmt = $conn->prepare("INSERT INTO `user_knowledge` (user_id, knowledge_id, heading) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $knowledge_id, $heading);

    if ($stmt->execute()) {
        echo "<script>alert('Skill added successfully!'); window.location.href='../pages/skills.php';</script>";
    } else {
        echo "<script>alert('Failed to add skill!'); window.location.href='../pages/skills.php';</script>";
    }
    $stmt->close();
}
?>
