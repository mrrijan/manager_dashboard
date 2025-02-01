<?php
include "../includes/header.php";
include "../includes/sidebar.php";
include "../config/db.php";

// Fetch Active Projects
$result = $conn->query("SELECT COUNT(*) AS total FROM projects WHERE project_status='active'");
$data = $result->fetch_assoc();
$active_projects = $data ? $data['total'] : 0;

// Fetch Total Projects
$result = $conn->query("SELECT COUNT(*) AS total FROM projects");
$data = $result->fetch_assoc();
$total_projects = $data ? $data['total'] : 0;

// Calculate Inactive Projects
$inactive_projects = $total_projects - $active_projects;

// Fetch Active Users
$result = $conn->query("SELECT COUNT(*) AS total FROM users_info WHERE status='Active'");
$data = $result->fetch_assoc();
$active_users = $data ? $data['total'] : 0;

// Fetch Personal Todos - Active
$result = $conn->query("SELECT COUNT(*) AS total FROM `personal todos` WHERE `Status`='Active'");
$data = $result->fetch_assoc();
$active_todos = $data ? $data['total'] : 0;

// Fetch Personal Todos - Completed
$result = $conn->query("SELECT COUNT(*) AS total FROM `personal todos` WHERE `Status`='Completed'");
$data = $result->fetch_assoc();
$completed_todos = $data ? $data['total'] : 0;

?>

<div class="content">
    <h1>Dashboard Overview</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4">
                <h3>Active Projects</h3>
                <canvas id="projectsChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <h3>Active Users</h3>
                <canvas id="usersChart"></canvas>
            </div>
            <div class="card p-4 mt-3">
                <h3>Personal Todos</h3>
                <canvas id="todosChart"></canvas>
            </div>
        </div>
        <!-- <div class="col-md-4">
           
        </div> -->
    </div>
</div>

<!-- Bootstrap & Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ensure PHP values are correctly inserted
    var activeProjects = <?= json_encode($active_projects) ?>;
    var inactiveProjects = <?= json_encode($inactive_projects) ?>;
    var activeUsers = <?= json_encode($active_users) ?>;
    var activeTodos = <?= json_encode($active_todos) ?>;
    var completedTodos = <?= json_encode($completed_todos) ?>;
    
    console.log("Active Projects:", activeProjects);  // Debugging
    console.log("Inactive Projects:", inactiveProjects);  // Debugging
    console.log("Active Users:", activeUsers);  // Debugging

    // Data for Projects Chart
    var projectsChart = new Chart(document.getElementById('projectsChart'), {
        type: 'pie',
        data: {
            labels: ['Active Projects', 'Inactive Projects'],
            datasets: [{
                data: [activeProjects, inactiveProjects], 
                backgroundColor: ['#007bff', '#f8d7da']
            }]
        }
    });

    // Data for Users Chart
    var usersChart = new Chart(document.getElementById('usersChart'), {
        type: 'bar',
        data: {
            labels: ['Active Users'],
            datasets: [{
                label: 'Number of Users',
                data: [activeUsers],
                backgroundColor: ['#28a745']
            }]
        }
    });

    var todosChart = new Chart(document.getElementById('todosChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active Todos', 'Completed Todos'],
            datasets: [{
                data: [activeTodos, completedTodos],
                backgroundColor: ['#ffc107', '#17a2b8']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            cutoutPercentage: 60
        }
    });
</script>

</body>
</html>
