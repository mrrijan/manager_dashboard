<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

// Fetch all tags from the database
$query = "SELECT * FROM `tags` ORDER BY tagId ASC";
$result = $conn->query($query);
?>

<div class="content">
    <h1>Manage Tags</h1>

    <!-- Add New Tag Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTagModal">+ Add Tag</button>

    <!-- Tags Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Tag ID</th>
                <th>Tag Name</th>
                <th>Tag Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['tagId']; ?></td>
                    <td><?= htmlspecialchars($row['tagName']); ?></td>
                    <td><?= $row['tagType']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn"
                                data-id="<?= $row['tagId']; ?>"
                                data-name="<?= htmlspecialchars($row['tagName']); ?>"
                                data-type="<?= $row['tagType']; ?>"
                                data-bs-toggle="modal" data-bs-target="#editTagModal">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['tagId']; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Add Tag Modal -->
<div class="modal fade" id="addTagModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_tag.php" method="POST">
                    <label>Tag Name:</label>
                    <input type="text" name="tag_name" class="form-control" required>
                    <label>Tag Type:</label>
                    <select name="tag_type" class="form-control" required>
                        <option value="Technical">Technical</option>
                        <option value="Non-Technical">Non-Technical</option>
                    </select>
                    <button type="submit" class="btn btn-success mt-3">Add Tag</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tag Modal -->
<div class="modal fade" id="editTagModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/update_tag.php" method="POST">
                    <input type="hidden" name="tag_id" id="edit-tag-id">
                    <label>Tag Name:</label>
                    <input type="text" name="tag_name" id="edit-tag-name" class="form-control" required>
                    <label>Tag Type:</label>
                    <select name="tag_type" id="edit-tag-type" class="form-control" required>
                        <option value="Technical">Technical</option>
                        <option value="Non-Technical">Non-Technical</option>
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
            let tagId = this.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this tag?")) {
                window.location.href = `../actions/delete_tag.php?id=${tagId}`;
            }
        });
    });

    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-tag-id").value = this.getAttribute("data-id");
            document.getElementById("edit-tag-name").value = this.getAttribute("data-name");
            document.getElementById("edit-tag-type").value = this.getAttribute("data-type");
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
