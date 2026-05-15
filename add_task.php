<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$projects = mysqli_query($conn, "SELECT * FROM projects");

if(isset($_POST['add_task'])){

 $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);

$task_name = mysqli_real_escape_string($conn, $_POST['task_name']);

$description = mysqli_real_escape_string($conn, $_POST['description']);

$status = mysqli_real_escape_string($conn, $_POST['status']);

$deadline = mysqli_real_escape_string($conn, $_POST['deadline']);

    $query = "INSERT INTO tasks
    (project_id, task_name, description, status, deadline)

    VALUES

    ('$project_id','$task_name','$description',
    '$status','$deadline')";

    mysqli_query($conn, $query);

    header("Location: tasks.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Task</title>

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
Add New Task
</h2>

<form method="POST">

<div class="mb-3">

<label>Select Project</label>

<select name="project_id"
        class="form-control"
        required>

<option value="">Choose Project</option>

<?php while($project = mysqli_fetch_assoc($projects)){ ?>

<option value="<?php echo $project['id']; ?>">

<?php echo $project['project_name']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Task Name</label>

<input type="text"
       name="task_name"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description"
          class="form-control"
          rows="5"
          required></textarea>

</div>

<div class="row">

<div class="col-md-6">

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

<button type="submit"
        name="add_task"
        class="btn btn-success">

Add Task

</button>

<a href="tasks.php"
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