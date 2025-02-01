<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

if (!isset($_GET['project_id'])) {
    echo "<div class='content'><p>Invalid Project ID.</p></div>";
    exit();
}

$project_id = $_GET['project_id'];

// Fetch project details
$projectQuery = "SELECT project_name FROM projects WHERE project_id = ?";
$stmt = $conn->prepare($projectQuery);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$projectResult = $stmt->get_result();
$project = $projectResult->fetch_assoc();

// Fetch all users
$userQuery = "SELECT user_id, first_name, last_name FROM users_info WHERE status='Active'";
$userResult = $conn->query($userQuery);
?>

<div class="content">
    <h2>Assign Users to <?= $project['project_name']; ?></h2>

    <form action="../actions/assign_user.php" method="POST">
        <input type="hidden" name="project_id" value="<?= $project_id; ?>">

        <label for="user">Select User:</label>
        <select name="user_id" class="form-control">
            <?php while ($user = $userResult->fetch_assoc()) { ?>
                <option value="<?= $user['user_id']; ?>"><?= $user['first_name'] . " " . $user['last_name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit" class="btn btn-success mt-2">Assign User</button>
    </form>
</div>

</body>
</html>
