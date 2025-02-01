<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

$manager_id = $_SESSION['user_id'];

// Fetch all tasks
$query = "SELECT t.*, u1.first_name AS assigned_to_name, u2.first_name AS assigned_by_name, p.project_name 
          FROM tasks t
          JOIN users_info u1 ON t.`Assigned To` = u1.user_id
          JOIN users_info u2 ON t.`Assigned By` = u2.user_id
          JOIN projects p ON t.`Project ID` = p.project_id
          ORDER BY t.`Creation Date` DESC";

$result = $conn->query($query);
?>

<div class="content">
    <h1>Task Management</h1>

    <!-- Add New Task Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">+ Assign Task</button>

    <!-- Task Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Task</th>
                <th>Assigned To</th>
                <th>Project</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['Task Description']); ?></td>
                    <td><?= $row['assigned_to_name']; ?></td>
                    <td><?= $row['project_name']; ?></td>
                    <td><?= date("Y-m-d", strtotime($row['Due Date'])); ?></td>
                    <td>
                        <span class="badge <?= $row['Status'] == 'Completed' ? 'bg-success' : 'bg-warning' ?>">
                            <?= $row['Status']; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['Status'] != 'Completed') { ?>
                            <button class="btn btn-success btn-sm complete-btn" data-id="<?= $row['Task ID']; ?>">Complete</button>
                            <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="<?= $row['Task ID']; ?>"
                                    data-description="<?= htmlspecialchars($row['Task Description']); ?>"
                                    data-due_date="<?= date('Y-m-d', strtotime($row['Due Date'])); ?>"
                                    data-bs-toggle="modal" data-bs-target="#editTaskModal">
                                Edit
                            </button>
                        <?php } ?>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['Task ID']; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_task.php" method="POST">
                    <label>Task Description:</label>
                    <input type="text" name="description" class="form-control" required>

                    <label>Assign To:</label>
                    <select name="assigned_to" class="form-control" required>
                        <option value="">Select Employee</option>
                        <?php
                        $users = $conn->query("SELECT user_id, first_name FROM users_info WHERE status='Active'");
                        while ($user = $users->fetch_assoc()) {
                            echo "<option value='{$user['user_id']}'>{$user['first_name']}</option>";
                        }
                        ?>
                    </select>

                    <label>Project:</label>
                    <select name="project_id" class="form-control" required>
                        <option value="">Select Project</option>
                        <?php
                        $projects = $conn->query("SELECT project_id, project_name FROM projects WHERE project_status='active'");
                        while ($project = $projects->fetch_assoc()) {
                            echo "<option value='{$project['project_id']}'>{$project['project_name']}</option>";
                        }
                        ?>
                    </select>

                    <label>Due Date:</label>
                    <input type="date" name="due_date" class="form-control" required>

                    <button type="submit" class="btn btn-success mt-3">Assign Task</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/update_task.php" method="POST">
                    <input type="hidden" name="task_id" id="edit-task-id">
                    <label>Task Description:</label>
                    <input type="text" name="description" id="edit-task-desc" class="form-control" required>
                    <label>Due Date:</label>
                    <input type="date" name="due_date" id="edit-task-date" class="form-control" required>
                    <button type="submit" class="btn btn-success mt-3">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Complete Task
    document.querySelectorAll(".complete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let taskId = this.getAttribute("data-id");
            if (confirm("Mark this task as completed?")) {
                window.location.href = `../actions/complete_task.php?id=${taskId}`;
            }
        });
    });

    // Delete Task
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let taskId = this.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this task?")) {
                window.location.href = `../actions/delete_task.php?id=${taskId}`;
            }
        });
    });

    // Edit Task - Populate modal with existing data
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-task-id").value = this.getAttribute("data-id");
            document.getElementById("edit-task-desc").value = this.getAttribute("data-description");

            let rawDate = this.getAttribute("data-due_date");
            console.log("Date Before Processing: ", rawDate);

            if (rawDate) {
                document.getElementById("edit-task-date").value = rawDate;
            }
        });
    });
</script>

</body>
</html>
