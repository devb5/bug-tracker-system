<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$projects = mysqli_query($conn, "SELECT * FROM projects");

if(isset($_POST['add_bug'])){

    $project_id = $_POST['project_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

   $screenshot = "";

if(isset($_FILES['screenshot']['name']) 
&& $_FILES['screenshot']['name'] != ""){

    $allowed = ['jpg','jpeg','png'];

    $filename = $_FILES['screenshot']['name'];

    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if(in_array($file_ext,$allowed)){

        $screenshot = time() . "_" . $filename;

        $tmp_name = $_FILES['screenshot']['tmp_name'];

        move_uploaded_file($tmp_name,
        "uploads/" . $screenshot);

    }else{

        die("Only JPG, JPEG, PNG files allowed");

    }
}

    $query = "INSERT INTO bugs
    (project_id,title,description,priority,status,screenshot)

    VALUES

    ('$project_id','$title','$description',
    '$priority','$status','$screenshot')";

    mysqli_query($conn, $query);

$user_id = $_SESSION['user_id'];

$activity = "Reported a bug";

mysqli_query($conn,

"INSERT INTO activity_logs(user_id,activity)

VALUES('$user_id','$activity')");

header("Location: bugs.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Report Bug</title>

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
Report New Bug
</h2>

<form method="POST" enctype="multipart/form-data">

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

<label>Bug Title</label>

<input type="text"
       name="title"
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

<label>Priority</label>

<select name="priority"
        class="form-control">

<option value="Low">Low</option>
<option value="Medium">Medium</option>
<option value="High">High</option>
<option value="Critical">Critical</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label>Status</label>

<select name="status"
        class="form-control">

<option value="Open">Open</option>
<option value="In Progress">In Progress</option>
<option value="Resolved">Resolved</option>
<option value="Closed">Closed</option>

</select>

</div>

</div>

</div>

<div class="mb-3">

<label>Upload Screenshot</label>

<input type="file"
       name="screenshot"
       class="form-control">

</div>

<button type="submit"
        name="add_bug"
        class="btn btn-danger">

Submit Bug

</button>

<a href="bugs.php"
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