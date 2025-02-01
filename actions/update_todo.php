<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle task update
    $task_id = $_POST['task_id'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $query = "UPDATE `personal todos` SET `Description` = ?, `Due Date` = ? WHERE `Item ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $description, $due_date, $task_id);

    if ($stmt->execute()) {
        echo "<script>alert('Task updated successfully!'); window.location.href='../pages/todo.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
} elseif (isset($_GET['id']) && $_GET['action'] == "complete") {
    // Handle task completion
    $task_id = $_GET['id'];
    $query = "UPDATE `personal todos` SET `Status` = 'Completed' WHERE `Item ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        echo "<script>alert('Task marked as completed!'); window.location.href='../pages/todo.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
