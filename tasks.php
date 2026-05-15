<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

if($_SESSION['user_role'] == 'tester'){
    die("Access Denied");
}

$query = "SELECT tasks.*, projects.project_name
FROM tasks
LEFT JOIN projects
ON tasks.project_id = projects.id
ORDER BY tasks.id DESC";

$result = mysqli_query($conn,$query);

$user_id = $_SESSION['user_id'];

$activity = "Created a new task";

mysqli_query($conn,

"INSERT INTO activity_logs(user_id,activity)

VALUES('$user_id','$activity')");

?>

<!DOCTYPE html>
<html>
<head>

<title>Tasks</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

<script src="assets/js/darkmode.js"></script>

</head>

<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main-content">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Task Management</h2>

<a href="add_task.php" class="btn btn-success">
Add Task
</a>

</div>

<div class="card shadow">

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Project</th>
<th>Task Name</th>
<th>Description</th>
<th>Status</th>
<th>Deadline</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['project_name']; ?></td>

<td><?php echo $row['task_name']; ?></td>

<td><?php echo $row['description']; ?></td>

<td>

<?php

if($row['status']=="Pending"){
    echo "<span class='badge bg-warning'>Pending</span>";
}
elseif($row['status']=="In Progress"){
    echo "<span class='badge bg-primary'>In Progress</span>";
}
else{
    echo "<span class='badge bg-success'>Completed</span>";
}

?>

</td>

<td><?php echo $row['deadline']; ?></td>

<td>

<a href="delete_task.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<div class="footer">
© 2026 Bug Tracking & Project Management System
</div>

</div>


</body>
</html>