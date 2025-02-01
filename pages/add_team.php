<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

if (!isset($_GET['project_id'])) {
    echo "<div class='content'><p>Invalid Project ID.</p></div>";
    exit();
}

$project_id = $_GET['project_id'];

// Fetch users to assign
$userQuery = "SELECT user_id, first_name, last_name FROM users_info WHERE status='Active'";
$userResult = $conn->query($userQuery);
?>

<div class="content">
    <h2>Add Members to Project</h2>

    <form action="../actions/add_team_member.php" method="POST">
        <input type="hidden" name="project_id" value="<?= $project_id; ?>">

        <label>Select Team Member:</label>
        <select name="user_id" class="form-control">
            <?php while ($user = $userResult->fetch_assoc()) { ?>
                <option value="<?= $user['user_id']; ?>"><?= $user['first_name'] . " " . $user['last_name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit" class="btn btn-success mt-2">Add to Project</button>
    </form>
</div>

</body>
</html>
