<?php
include "../config/db.php";
session_start();
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $query = "UPDATE tasks SET `Status` = 'Completed', `Date Completed` = NOW() WHERE `Task ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        header("Location: ../pages/tasks.php?success=Task Completed");
    } else {
        header("Location: ../pages/tasks.php?error=Error Completing Task");
    }
    exit();
}
?>
