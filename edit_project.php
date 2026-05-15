<?php
include 'includes/admin_check.php';
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM projects WHERE id='$id'");

$project = mysqli_fetch_assoc($result);

if(isset($_POST['update_project'])){

    $project_name = mysqli_real_escape_string($conn,
    $_POST['project_name']);

    $description = mysqli_real_escape_string($conn,
    $_POST['description']);

    $start_date = $_POST['start_date'];

    $deadline = $_POST['deadline'];

    $status = $_POST['status'];

    $query = "UPDATE projects SET

    project_name='$project_name',
    description='$description',
    start_date='$start_date',
    deadline='$deadline',
    status='$status'

    WHERE id='$id'";

    mysqli_query($conn, $query);

    header("Location: projects.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Project</title>

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
Edit Project
</h2>

<form method="POST">

<div class="mb-3">

<label>Project Name</label>

<input type="text"
       name="project_name"
       class="form-control"
       value="<?php echo $project['project_name']; ?>"
       required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description"
          class="form-control"
          rows="4"
          required><?php echo $project['description']; ?></textarea>

</div>

<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label>Start Date</label>

<input type="date"
       name="start_date"
       class="form-control"
       value="<?php echo $project['start_date']; ?>"
       required>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label>Deadline</label>

<input type="date"
       name="deadline"
       class="form-control"
       value="<?php echo $project['deadline']; ?>"
       required>

</div>

</div>

</div>

<div class="mb-3">

<label>Status</label>

<select name="status"
        class="form-control">

<option value="Pending"
<?php if($project['status']=='Pending') echo 'selected'; ?>>
Pending
</option>

<option value="In Progress"
<?php if($project['status']=='In Progress') echo 'selected'; ?>>
In Progress
</option>

<option value="Completed"
<?php if($project['status']=='Completed') echo 'selected'; ?>>
Completed
</option>

</select>

</div>

<button type="submit"
        name="update_project"
        class="btn btn-primary">

Update Project

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