<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

// Fetch notifications with user details
$query = "SELECT n.*, ui.first_name, ui.last_name 
          FROM `Notifications` n
          JOIN users_info ui ON n.`User ID` = ui.`user_id`
          ORDER BY `Date` DESC";
$result = $conn->query($query);
?>

<div class="content">
    <h1>Notifications</h1>

    <!-- Add New Notification Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNotificationModal">+ Add Notification</button>

    <!-- Notifications Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Date</th>
                <th>Notification</th>
                <th>Colour</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                    <td><?= date("Y-m-d H:i:s", strtotime($row['Date'])); ?></td>
                    <td><?= htmlspecialchars($row['Notification Text']); ?></td>
                    <td>
                        <span class="badge" style="background-color: <?= htmlspecialchars($row['Notification Colour']); ?>;">
                            <?= htmlspecialchars($row['Notification Colour']); ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn"
                                data-id="<?= $row['Notification ID']; ?>"
                                data-text="<?= htmlspecialchars($row['Notification Text']); ?>"
                                data-colour="<?= htmlspecialchars($row['Notification Colour']); ?>"
                                data-bs-toggle="modal" data-bs-target="#editNotificationModal">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['Notification ID']; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Add Notification Modal -->
<div class="modal fade" id="addNotificationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_notification.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
                    <label>Notification Text:</label>
                    <textarea name="text" class="form-control" required></textarea>
                    <label>Notification Colour:</label>
                    <input type="color" name="colour" class="form-control" required>
                    <button type="submit" class="btn btn-success mt-3">Add Notification</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Notification Modal -->
<div class="modal fade" id="editNotificationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/update_notification.php" method="POST">
                    <input type="hidden" name="notification_id" id="edit-notification-id">
                    <label>Notification Text:</label>
                    <textarea name="text" id="edit-notification-text" class="form-control" required></textarea>
                    <label>Notification Colour:</label>
                    <input type="color" name="colour" id="edit-notification-colour" class="form-control" required>
                    <button type="submit" class="btn btn-success mt-3">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript for Edit & Delete -->
<script>
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let notificationId = this.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this notification?")) {
                window.location.href = `../actions/delete_notification.php?id=${notificationId}`;
            }
        });
    });

    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-notification-id").value = this.getAttribute("data-id");
            document.getElementById("edit-notification-text").value = this.getAttribute("data-text");
            document.getElementById("edit-notification-colour").value = this.getAttribute("data-colour");
        });
    });
</script>

</body>
</html>
