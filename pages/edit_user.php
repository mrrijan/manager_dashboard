<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

if (!isset($_GET['user_id'])) {
    echo "<div class='content'><p>Invalid User ID.</p></div>";
    exit();
}

$user_id = $_GET['user_id'];

$query = "SELECT * FROM users_info WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<div class="content">
    <h2>Edit User</h2>
    <form action="../actions/update_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $user_id; ?>">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
        <label>First Name:</label>
        <input type="text" name="first_name" class="form-control" value="<?= $user['first_name']; ?>" required>
        <label>Last Name:</label>
        <input type="text" name="last_name" class="form-control" value="<?= $user['last_name']; ?>" required>
        <label>Contact:</label>
        <input type="text" name="contact_number" class="form-control" value="<?= $user['contact_number']; ?>" required>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>

</body>
</html>
