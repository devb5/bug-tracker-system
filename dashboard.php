<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$project_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM projects"));
$bug_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bugs"));
$task_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tasks"));
$user_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));

$recent_projects = mysqli_query($conn,"SELECT * FROM projects ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="assets/css/style.css">

<script src="assets/js/darkmode.js"></script>

</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main-content">

<!-- TOP BAR -->

<button onclick="toggleDarkMode()"
class="btn btn-dark">

Dark Mode

</button>

<div class="card shadow mb-4">

<div class="card-body d-flex justify-content-between align-items-center">

<div>

<h3 class="mb-1">
Bug Tracking Dashboard
</h3>

<p class="text-muted mb-0">
Welcome back,
<b><?php echo $_SESSION['user_name']; ?></b>
</p>

</div>

<span class="badge bg-dark p-2">
<?php echo $_SESSION['user_role']; ?>
</span>

</div>

</div>

<!-- STATS CARDS -->

<div class="row">

<div class="col-md-3 mb-4">

<div class="card shadow stats-card">

<div class="card-body d-flex justify-content-between align-items-center">

<div>
<h6>Total Projects</h6>
<h2><?php echo $project_count; ?></h2>
</div>

<i class="fa-solid fa-folder fa-3x text-primary"></i>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow stats-card">

<div class="card-body d-flex justify-content-between align-items-center">

<div>
<h6>Total Bugs</h6>
<h2><?php echo $bug_count; ?></h2>
</div>

<i class="fa-solid fa-bug fa-3x text-danger"></i>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow stats-card">

<div class="card-body d-flex justify-content-between align-items-center">

<div>
<h6>Total Tasks</h6>
<h2><?php echo $task_count; ?></h2>
</div>

<i class="fa-solid fa-list-check fa-3x text-success"></i>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow stats-card">

<div class="card-body d-flex justify-content-between align-items-center">

<div>
<h6>Total Users</h6>
<h2><?php echo $user_count; ?></h2>
</div>

<i class="fa-solid fa-users fa-3x text-warning"></i>

</div>

</div>

</div>

</div>

<!-- TABLE + CHART -->

<div class="row">

<div class="col-md-6 mb-4">

<div class="card shadow h-100">

<div class="card-header bg-dark text-white">
Recent Projects
</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover">

<tr>
<th>ID</th>
<th>Project</th>
<th>Status</th>
</tr>

<?php while($project = mysqli_fetch_assoc($recent_projects)){ ?>

<tr>

<td><?php echo $project['id']; ?></td>

<td><?php echo $project['project_name']; ?></td>

<td><?php echo $project['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</div>

<div class="col-md-6 mb-4">

<div class="card shadow h-100">

<div class="card-header bg-primary text-white">
Project Statistics
</div>

<div class="card-body">

<canvas id="projectChart"></canvas>

</div>

</div>

</div>

</div>

<!-- SECOND CHART -->

<div class="row">

<div class="col-md-12">

<div class="card shadow">

<div class="card-header bg-success text-white">
Bug Analysis
</div>

<div class="card-body">

<canvas id="bugChart"></canvas>

</div>

</div>

</div>

</div>

<!-- FOOTER -->

<div class="footer">

© 2026 Bug Tracking & Project Management System

</div>

</div>

<script>

const projectChart = document.getElementById('projectChart');

new Chart(projectChart, {

type: 'doughnut',

data: {

labels: ['Projects','Tasks','Users'],

datasets: [{

data: [
<?php echo $project_count; ?>,
<?php echo $task_count; ?>,
<?php echo $user_count; ?>
]

}]

}

});

const bugChart = document.getElementById('bugChart');

new Chart(bugChart, {

type: 'bar',

data: {

labels: ['Bugs'],

datasets: [{

label:'Total Bugs',

data:[<?php echo $bug_count; ?>]

}]

}

});

</script>



</body>
</html>