<?php
include "../config/db.php";

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $query = "DELETE FROM `personal todos` WHERE `Item ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        echo "<script>alert('Task deleted successfully!'); window.location.href='../pages/todo.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
