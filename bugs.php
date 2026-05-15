<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

if($_SESSION['user_role'] == 'developer'){
    die("Access Denied");
}

$query = "SELECT bugs.*, projects.project_name
FROM bugs
LEFT JOIN projects
ON bugs.project_id = projects.id
ORDER BY bugs.id DESC";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Bugs</title>

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

<h2>Bug Management</h2>

<a href="add_bug.php" class="btn btn-danger">
Report Bug
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
<th>Title</th>
<th>Priority</th>
<th>Status</th>
<th>Screenshot</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['project_name']; ?></td>

<td><?php echo $row['title']; ?></td>

<td>

<?php

if($row['priority']=="Low"){
    echo "<span class='badge bg-success'>Low</span>";
}
elseif($row['priority']=="Medium"){
    echo "<span class='badge bg-warning'>Medium</span>";
}
elseif($row['priority']=="High"){
    echo "<span class='badge bg-danger'>High</span>";
}
else{
    echo "<span class='badge bg-dark'>Critical</span>";
}

?>

</td>

<td>

<?php

if($row['status']=="Open"){
    echo "<span class='badge bg-danger'>Open</span>";
}
elseif($row['status']=="In Progress"){
    echo "<span class='badge bg-primary'>In Progress</span>";
}
elseif($row['status']=="Resolved"){
    echo "<span class='badge bg-success'>Resolved</span>";
}
else{
    echo "<span class='badge bg-secondary'>Closed</span>";
}

?>

</td>

<td>

<?php if($row['screenshot']){ ?>

<img src="uploads/<?php echo $row['screenshot']; ?>"
width="100">

<?php } ?>

</td>

<td>

<a href="delete_bug.php?id=<?php echo $row['id']; ?>"
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