<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/sidebar.php";
?>

<div class="content">
    <h1>Project Management</h1>
    <!-- Search Filter -->
    <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Search for projects...">
    </div>
    <!-- Projects Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Manager</th>
                <th>Leader</th>
                <th>Creator</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="projectTable">
            <?php
            $query = "SELECT p.*, u1.first_name AS manager_name, u2.first_name AS leader_name 
                      FROM projects p
                      LEFT JOIN users_info u1 ON p.project_manager = u1.user_id
                      LEFT JOIN users_info u2 ON p.project_leader = u2.user_id";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['project_id']}</td>";
                echo "<td>{$row['project_name']}</td>";
                echo "<td>{$row['manager_name']}</td>";
                echo "<td>" . ($row['leader_name'] ? $row['leader_name'] : "<span class='text-muted'>Not Assigned</span>") . "</td>";
                echo "<td>{$row['project_creator']}</td>";
                echo "<td><span class='badge ". ($row['project_status'] == 'active' ? "bg-success" : "bg-danger") . "'>{$row['project_status']}</span></td>";
                echo "<td>
                        <button class='btn btn-primary assign-leader' data-id='{$row['project_id']}'>Assign Leader</button>
                        <button class='btn btn-success add-team' data-id='{$row['project_id']}'>Add Members</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript to handle Assign Leader & Add Members -->
<script>
        // Live Search Filter
        document.getElementById("search").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#projectTable tr");
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });

    document.querySelectorAll(".assign-leader").forEach(button => {
        button.addEventListener("click", function() {
            let projectId = this.getAttribute("data-id");
            window.location.href = `assign_leader.php?project_id=${projectId}`;
        });
    });

    document.querySelectorAll(".add-team").forEach(button => {
        button.addEventListener("click", function() {
            let projectId = this.getAttribute("data-id");
            window.location.href = `add_team.php?project_id=${projectId}`;
        });
    });
</script>

</body>
</html>
