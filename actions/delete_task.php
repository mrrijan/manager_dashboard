<?php
include "../config/db.php";
session_start();
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $query = "DELETE FROM tasks WHERE `Task ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        header("Location: ../pages/tasks.php?success=Task Deleted");
    } else {
        header("Location: ../pages/tasks.php?error=Error Deleting Task");
    }
    exit();
}
?>
