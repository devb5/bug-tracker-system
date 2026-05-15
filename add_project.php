<?php
include 'includes/admin_check.php';
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

if(isset($_POST['add_project'])){

    $project_name = $_POST['project_name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $created_by = $_SESSION['user_id'];

    $query = "INSERT INTO projects
    (project_name, description, start_date, deadline, status, created_by)

    VALUES

    ('$project_name','$description','$start_date',
    '$deadline','$status','$created_by')";

    mysqli_query($conn, $query);
    
    $user_id = $_SESSION['user_id'];

$activity = "Created a new project";

mysqli_query($conn,

"INSERT INTO activity_logs(user_id,activity)

VALUES('$user_id','$activity')");

    header("Location: projects.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Project</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.form-box{
    background:white;
    padding:30px;
    border-radius:15px;
    margin-top:50px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="form-box shadow">

<h2 class="mb-4">
Add New Project
</h2>

<form method="POST">

<div class="mb-3">

<label>Project Name</label>

<input type="text"
       name="project_name"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description"
          class="form-control"
          rows="4"
          required></textarea>

</div>

<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label>Start Date</label>

<input type="date"
       name="start_date"
       class="form-control"
       required>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label>Deadline</label>

<input type="date"
       name="deadline"
       class="form-control"
       required>

</div>

</div>

</div>

<div class="mb-3">

<label>Status</label>

<select name="status"
        class="form-control">

<option value="Pending">Pending</option>

<option value="In Progress">
In Progress
</option>

<option value="Completed">
Completed
</option>

</select>

</div>

<button type="submit"
        name="add_project"
        class="btn btn-success">

Add Project

</button>

<a href="projects.php"
   class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

</body>
</html>