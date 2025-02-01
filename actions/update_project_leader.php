<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $leader_id = $_POST['leader_id'];

    $query = "UPDATE projects SET project_leader = ? WHERE project_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $leader_id, $project_id);

    if ($stmt->execute()) {
        echo "<script>alert('Project Leader Assigned!'); window.location.href='../pages/projects.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
