<?php
include "../config/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $assigned_to = $_POST['assigned_to'];
    $project_id = $_POST['project_id'];
    $due_date = $_POST['due_date'];
    $assigned_by = $_SESSION['user_id']; // Manager assigning the task

    $query = "INSERT INTO tasks (`Assigned To`, `Assigned By`, `Project ID`, `Creation Date`, `Due Date`, `Task Description`, `Status`)
              VALUES (?, ?, ?, NOW(), ?, ?, 'Active')";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiiss", $assigned_to, $assigned_by, $project_id, $due_date, $description);

    if ($stmt->execute()) {
        header("Location: ../pages/tasks.php?success=Task Assigned");
    } else {
        header("Location: ../pages/tasks.php?error=Error Assigning Task");
    }
    exit();
}
?>
