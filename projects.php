<?php
include 'includes/admin_check.php';
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
}

$limit = 5;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $limit;

$query = "SELECT * FROM projects
LIMIT $start, $limit";

$result = mysqli_query($conn,$query);

$total_query = mysqli_query($conn,
"SELECT COUNT(*) as total FROM projects");

$total_row = mysqli_fetch_assoc($total_query);

$total_pages = ceil($total_row['total'] / $limit);

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Projects</title>

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

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="me-4">Projects</h2>

<div>

<a href="add_project.php"
class="btn btn-primary">

Add Project

</a>

</div>

</div>

<a href="export_projects.php"
class="btn btn-success">

Export PDF

</a>

</div>

<form method="GET" class="mb-4">

<div class="input-group" style="max-width:500px;">

<input type="text"
       name="search"
       class="form-control"
       placeholder="Search Projects">

<button class="btn btn-dark">
Search
</button>

</div>

</form>

<div class="card shadow">

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Project Name</th>
<th>Description</th>
<th>Start Date</th>
<th>Deadline</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['project_name']; ?></td>

<td><?php echo $row['description']; ?></td>

<td><?php echo $row['start_date']; ?></td>

<td><?php echo $row['deadline']; ?></td>

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

<td>

<a href="edit_project.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary btn-sm">
Edit
</a>

<a href="delete_project.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<div class="mt-4">

<?php for($i=1; $i<=$total_pages; $i++){ ?>

<a href="?page=<?php echo $i; ?>"
class="btn btn-dark btn-sm">

<?php echo $i; ?>

</a>

<?php } ?>

</div>

</div>

</div>

</div>

<div class="footer">
© 2026 Bug Tracking & Project Management System
</div>

</div>

</body>
</html>