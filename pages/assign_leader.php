<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

if (!isset($_GET['project_id'])) {
    echo "<div class='content'><p>Invalid Project ID.</p></div>";
    exit();
}

$project_id = $_GET['project_id'];

// Fetch available leaders
$leaderQuery = "SELECT user_id, first_name, last_name FROM users_info WHERE status='Active'";
$leaderResult = $conn->query($leaderQuery);
?>

<div class="content">
    <h2>Assign Project Leader</h2>

    <form action="../actions/update_project_leader.php" method="POST">
        <input type="hidden" name="project_id" value="<?= $project_id; ?>">

        <label>Select Leader:</label>
        <select name="leader_id" class="form-control">
            <?php while ($leader = $leaderResult->fetch_assoc()) { ?>
                <option value="<?= $leader['user_id']; ?>"><?= $leader['first_name'] . " " . $leader['last_name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit" class="btn btn-success mt-2">Assign Leader</button>
    </form>
</div>

</body>
</html>
