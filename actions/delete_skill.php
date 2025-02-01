<?php
include "../config/db.php";

if (isset($_GET['user_id']) && isset($_GET['knowledge_id'])) {
    $user_id = $_GET['user_id'];
    $knowledge_id = $_GET['knowledge_id'];

    // Check if the user has more than one skill
    $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM `user_knowledge` WHERE user_id = ?");
    $stmtCheck->bind_param("i", $user_id);
    $stmtCheck->execute();
    $stmtCheck->bind_result($skillCount);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($skillCount > 1) {
        // Delete only the selected skill
        $stmt = $conn->prepare("DELETE FROM `user_knowledge` WHERE user_id = ? AND knowledge_id = ?");
        $stmt->bind_param("ii", $user_id, $knowledge_id);

        if ($stmt->execute()) {
            header("Location: ../pages/skills.php?success=deleted");
        } else {
            header("Location: ../pages/skills.php?error=failed");
        }
        $stmt->close();
    } else {
        // If it's the last skill, delete user from users_info
        $conn->begin_transaction(); // Start transaction to ensure both deletions succeed

        try {
            // Delete the last skill
            $stmtDeleteSkill = $conn->prepare("DELETE FROM `user_knowledge` WHERE user_id = ?");
            $stmtDeleteSkill->bind_param("i", $user_id);
            $stmtDeleteSkill->execute();
            $stmtDeleteSkill->close();

            // Delete the user from users_info
            $stmtDeleteUser = $conn->prepare("DELETE FROM `users_info` WHERE user_id = ?");
            $stmtDeleteUser->bind_param("i", $user_id);
            $stmtDeleteUser->execute();
            $stmtDeleteUser->close();

            // Commit the transaction
            $conn->commit();
            header("Location: ../pages/skills.php?success=user_deleted");
        } catch (Exception $e) {
            // Rollback in case of error
            $conn->rollback();
            header("Location: ../pages/skills.php?error=failed");
        }
    }
}
?>
