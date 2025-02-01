<?php
include "../config/db.php";

if (isset($_GET['user_id']) && isset($_GET['status'])) {
    $user_id = $_GET['user_id'];
    $status = $_GET['status'];

    $query = "UPDATE users_info SET status = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('User status updated!'); window.location.href='../pages/users.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
