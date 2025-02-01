<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manager_id = $_POST['manager_id'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $query = "INSERT INTO `personal todos` (`User ID`, `Creation Date`, `Due Date`, `Description`, `Status`) 
              VALUES (?, NOW(), ?, ?, 'Active')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $manager_id, $due_date, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Task added successfully!'); window.location.href='../pages/todo.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
