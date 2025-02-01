<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $user_id = $_POST['user_id'];

    // Check if user is already assigned
    $checkQuery = "SELECT * FROM user_projects WHERE user_id = ? AND project_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ii", $user_id, $project_id);
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('User is already assigned to this project!'); window.history.back();</script>";
        exit();
    }

    // Assign user to project
    $query = "INSERT INTO user_projects (user_id, project_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $project_id);

    if ($stmt->execute()) {
        echo "<script>alert('User assigned successfully!'); window.location.href='../pages/projects.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
