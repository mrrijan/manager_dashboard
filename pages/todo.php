<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

$manager_id = $_SESSION['user_id'];

$query = "SELECT * FROM `personal todos` WHERE `User ID` = ? ORDER BY `Creation Date` DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $manager_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="content">
    <h1>Personal To-Do List</h1>

    <!-- Add New Task Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">+ Add To-Do</button>

    <!-- To-Do Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Task</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['Description']); ?></td>
                    <td><?= date("Y-m-d", strtotime($row['Due Date'])); ?></td>
                    <td>
                        <span class="badge <?= $row['Status'] == 'Completed' ? 'bg-success' : 'bg-warning' ?>">
                            <?= $row['Status']; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['Status'] != 'Completed') { ?>
                            <button class="btn btn-success btn-sm complete-btn" data-id="<?= $row['Item ID']; ?>">Complete</button>
                            <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="<?= $row['Item ID']; ?>"
                                    data-description="<?= htmlspecialchars($row['Description']); ?>"
                                    data-due_date="<?= date('Y-m-d', strtotime($row['Due Date'])); ?>"
                                    data-bs-toggle="modal" data-bs-target="#editTaskModal">
                                Edit
                            </button>
                        <?php } ?>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['Item ID']; ?>">Delete</button>
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
                <h5 class="modal-title">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_todo.php" method="POST">
                    <input type="hidden" name="manager_id" value="<?= $manager_id; ?>">
                    <label>Task Description:</label>
                    <input type="text" name="description" class="form-control" required>
                    <label>Due Date:</label>
                    <input type="date" name="due_date" class="form-control" required>
                    <button type="submit" class="btn btn-success mt-3">Add Task</button>
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
                <form action="../actions/update_todo.php" method="POST">
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
                window.location.href = `../actions/update_todo.php?id=${taskId}&action=complete`;
            }
        });
    });

    // Delete Task
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let taskId = this.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this task?")) {
                window.location.href = `../actions/delete_todo.php?id=${taskId}`;
            }
        });
    });

    // Edit Task - Populate modal with existing data
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-task-id").value = this.getAttribute("data-id");
            document.getElementById("edit-task-desc").value = this.getAttribute("data-description");

            let rawDate = this.getAttribute("data-due_date"); // Fetch raw date
            console.log("Date Before Processing: ", rawDate);

            // Directly assign the raw date without converting to Date object
            if (rawDate) {
                document.getElementById("edit-task-date").value = rawDate;
            }
        });
    });
</script>

</body>
</html>
