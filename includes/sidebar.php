sidebar.php
<style>
    /* Sidebar Styling */
    .sidebar {
        width: 250px;
        height: 100vh;
        background: #343a40;
        padding-top: 50px;
        position: fixed;
        left: 0;
        top: 0; /* Sidebar starts from the very top */
        z-index: 1100; /* Higher than navbar */
        transition: 0.3s;
    }

    .sidebar a {
        color: white;
        padding: 15px;
        display: block;
        text-decoration: none;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: #495057;
    }

    /* Adjust content to prevent overlap */
    .content {
        margin-left: 250px; /* Adjust according to sidebar width */
        padding: 20px;
    }



</style>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <a href="../pages/dashboard.php"><i class="fas fa-tachometer-alt"></i>  Dashboard</a>
    <a href="../pages/projects.php"><i class="fas fa-folder-open"></i> Projects</a>
    <a href="../pages/users.php"><i class="fas fa-users"></i> Users</a>
    <a href="../pages/tasks.php"><i class="fas fa-tasks"></i> Tasks</a>
    <a href="../pages/tags.php"> Tags</a>
    <a href="../pages/knowledge.php"><i class="fas fa-book"></i>  Knowledge Base</a>
    <a href="../pages/skills.php"><i class="fas fa-chart-line"></i> Skill Tracking</a>
    <a href="../pages/todo.php"><i class="fas fa-list-alt"></i> Todo List</a>
    <a href="../pages/notifications.php"><i class="fas fa-bell"></i> Notifications</a>
</div>

