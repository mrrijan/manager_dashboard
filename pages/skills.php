<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

$query = "SELECT uk.*, ui.first_name, ui.last_name, ka.knowledge_section, ka.Heading
          FROM `user_knowledge` uk
          JOIN `users_info` ui ON uk.user_id = ui.user_id
          JOIN `Knowledge Area` ka ON uk.knowledge_id = ka.knowledge_id
          ORDER BY ui.first_name ASC";
$result = $conn->query($query);
?>

<div class="content">
    <?php if (isset($_GET['error']) && $_GET['error'] == "already_has_skill") { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> This user already has a skill assigned!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>
    <h1>Skill Tracking</h1>

    <!-- Add New Skill Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSkillModal">+ Add Skill</button>

    <!-- Skills Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Employee</th>
                <th>Skill Section</th>
                <th>Skill Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['first_name'] . " " . $row['last_name']; ?></td>
                    <td><?= $row['knowledge_section']; ?></td>
                    <td><?= $row['Heading']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" 
                                data-id="<?= $row['user_id']; ?>"
                                data-old-knowledge="<?= $row['knowledge_id']; ?>" 
                                data-knowledge="<?= $row['knowledge_id']; ?>"
                                data-name="<?= $row['Heading']; ?>"
                                data-bs-toggle="modal" data-bs-target="#editSkillModal">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['user_id']; ?>" data-knowledge="<?= $row['knowledge_id']; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_skill.php" method="POST">
                    <label>Employee:</label>
                    <select name="user_id" class="form-control" required>
                        <?php
                        $users = $conn->query("SELECT user_id, first_name, last_name FROM users_info");
                        while ($user = $users->fetch_assoc()) {
                            echo "<option value='{$user['user_id']}'>{$user['first_name']} {$user['last_name']}</option>";
                        }
                        ?>
                    </select>
                    <label>Skill:</label>
                    <select name="knowledge_id" class="form-control" required>
                        <?php
                        $skills = $conn->query("SELECT knowledge_id, Heading FROM `Knowledge Area`");
                        while ($skill = $skills->fetch_assoc()) {
                            echo "<option value='{$skill['knowledge_id']}'>{$skill['Heading']}</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-success mt-3">Add Skill</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Skill Modal -->
<div class="modal fade" id="editSkillModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/update_skill.php" method="POST">
                    <input type="hidden" name="user_id" id="edit-user-id">
                    <input type="hidden" name="old_knowledge_id" id="edit-old-knowledge-id">
                    <label>Skill:</label>
                    <select name="knowledge_id" id="edit-knowledge-id" class="form-control" required>
                        <?php
                        $skills = $conn->query("SELECT knowledge_id, Heading FROM `Knowledge Area`");
                        while ($skill = $skills->fetch_assoc()) {
                            echo "<option value='{$skill['knowledge_id']}'>{$skill['Heading']}</option>";
                        }
                        ?>
                    </select>
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
            let userId = this.getAttribute("data-id");
            let knowledgeId = this.getAttribute("data-knowledge");
            if (confirm("Are you sure you want to delete this skill?")) {
                window.location.href = `../actions/delete_skill.php?user_id=${userId}&knowledge_id=${knowledgeId}`;
            }
        });
    });

    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-user-id").value = this.getAttribute("data-id");
            document.getElementById("edit-old-knowledge-id").value = this.getAttribute("data-old-knowledge"); // Store old skill
            document.getElementById("edit-knowledge-id").value = this.getAttribute("data-knowledge");
        });
    });
</script>

</body>
</html>
