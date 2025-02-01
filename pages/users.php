<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";
?>

<div class="content">
    <h1>User Management</h1>

    <!-- Add New User Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Add User</button>

    <!-- Users Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM users_info";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['first_name']}</td>";
                echo "<td>{$row['last_name']}</td>";
                echo "<td>{$row['contact_number']}</td>";
                echo "<td><span class='badge ". ($row['status'] == 'Active' ? "bg-success" : "bg-danger") . "'>{$row['status']}</span></td>";
                echo "<td>
                        <button class='btn btn-warning btn-sm edit-btn' data-id='{$row['user_id']}'>Edit</button>
                        <button class='btn btn-danger btn-sm status-btn' data-id='{$row['user_id']}' data-status='{$row['status']}'>" . 
                        ($row['status'] == 'Active' ? "Deactivate" : "Activate") . "</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_user.php" method="POST">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                    <label>First Name:</label>
                    <input type="text" name="first_name" class="form-control" required>
                    <label>Last Name:</label>
                    <input type="text" name="last_name" class="form-control" required>
                    <label>Contact:</label>
                    <input type="text" name="contact_number" class="form-control" required>
                    <button type="submit" class="btn btn-success mt-3">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Activate/Deactivate User
    document.querySelectorAll(".status-btn").forEach(button => {
        button.addEventListener("click", function() {
            let userId = this.getAttribute("data-id");
            let currentStatus = this.getAttribute("data-status");
            let newStatus = currentStatus === "Active" ? "Inactive" : "Active";

            if (confirm(`Are you sure you want to ${newStatus} this user?`)) {
                window.location.href = `../actions/update_user_status.php?user_id=${userId}&status=${newStatus}`;
            }
        });
    });

    // Edit User (Redirect to edit form)
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            let userId = this.getAttribute("data-id");
            window.location.href = `edit_user.php?user_id=${userId}`;
        });
    });
</script>

</body>
</html>
