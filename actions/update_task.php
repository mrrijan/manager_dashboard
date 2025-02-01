<?php
include "../config/db.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $query = "UPDATE tasks SET `Task Description` = ?, `Due Date` = ? WHERE `Task ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $description, $due_date, $task_id);

    if ($stmt->execute()) {
        header("Location: ../pages/tasks.php?success=Task Updated");
    } else {
        header("Location: ../pages/tasks.php?error=Error Updating Task");
    }
    exit();
}
?>
