<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";

// Fetch knowledge entries along with user and tag details
$query = "SELECT ke.*, ui.first_name, ui.last_name, t.tagName 
          FROM `knowledge entries` ke 
          JOIN users_info ui ON ke.Author = ui.user_id 
          JOIN tags t ON ke.tagId = t.tagId
          ORDER BY `ke`.`Creation Date` DESC";
$result = $conn->query($query);
?>

<div class="content">
    <h1>Knowledge Base</h1>

    <!-- Add New Knowledge Entry Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addKnowledgeModal">+ Add Entry</button>

    <!-- Knowledge Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Preview</th>
                <th>Author</th>
                <th>Tags</th>
                <th>Knowledge Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['Post Title']); ?></td>
                    <td><?= htmlspecialchars($row['Post Preview']); ?></td>
                    <td><?= $row['first_name'] . " " . $row['last_name']; ?></td>
                    <td><?= htmlspecialchars($row['tagName']); ?></td>
                    <td><?= htmlspecialchars($row["knowledge section"]) ?>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" 
                                data-id="<?= $row['Post ID']; ?>"
                                data-title="<?= htmlspecialchars($row['Post Title']); ?>"
                                data-preview="<?= htmlspecialchars($row['Post Preview']); ?>"
                                data-content="<?= htmlspecialchars($row['Post Data']); ?>"
                                data-tag="<?= $row['tagId']; ?>"
                                data-bs-toggle="modal" data-bs-target="#editKnowledgeModal">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['Post ID']; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Add Knowledge Modal -->
<div class="modal fade" id="addKnowledgeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Knowledge Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/add_knowledge.php" method="POST">
                    <input type="hidden" name="author_id" value="<?= $_SESSION['user_id']; ?>">
                    <label>Title:</label>
                    <input type="text" name="title" class="form-control" required>
                    <label>Preview:</label>
                    <input type="text" name="preview" class="form-control" required>
                    <label>Content:</label>
                    <textarea name="content" class="form-control" required></textarea>
                    <label>Tags:</label>
                    <select name="tag_id" class="form-control">
                        <?php
                            $tags = $conn->query("SELECT * FROM `tags`");
                            while ($tag = $tags->fetch_assoc()) {
                                echo "<option value='{$tag['tagId']}'>{$tag['tagName']}</option>";
                            }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-success mt-3">Add Entry</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Knowledge Modal -->
<div class="modal fade" id="editKnowledgeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Knowledge Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../actions/update_knowledge.php" method="POST">
                    <input type="hidden" name="entry_id" id="edit-entry-id">
                    <label>Title:</label>
                    <input type="text" name="title" id="edit-entry-title" class="form-control" required>
                    <label>Preview:</label>
                    <input type="text" name="preview" id="edit-entry-preview" class="form-control" required>
                    <label>Content:</label>
                    <textarea name="content" id="edit-entry-content" class="form-control" required></textarea>
                    <label>Tags:</label>
                    <select name="tag_id" id="edit-entry-tags" class="form-control">
                        <?php
                            $tags = $conn->query("SELECT * FROM `tags`");
                            while ($tag = $tags->fetch_assoc()) {
                                echo "<option value='{$tag['tagId']}'>{$tag['tagName']}</option>";
                            }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-success mt-3">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Edit & Delete -->
<script>
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let entryId = this.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this entry?")) {
                window.location.href = `../actions/delete_knowledge.php?id=${entryId}`;
            }
        });
    });

    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-entry-id").value = this.getAttribute("data-id");
            document.getElementById("edit-entry-title").value = this.getAttribute("data-title");
            document.getElementById("edit-entry-preview").value = this.getAttribute("data-preview");
            document.getElementById("edit-entry-content").value = this.getAttribute("data-content");
            document.getElementById("edit-entry-tags").value = this.getAttribute("data-tag");
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
