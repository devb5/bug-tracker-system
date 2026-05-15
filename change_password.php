<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

if(isset($_POST['change_password'])){

    $current = md5($_POST['current_password']);
    $new = md5($_POST['new_password']);

    $id = $_SESSION['user_id'];

    $check = mysqli_query($conn,
    "SELECT * FROM users
    WHERE id='$id'
    AND password='$current'");

    if(mysqli_num_rows($check)>0){

        mysqli_query($conn,
        "UPDATE users
        SET password='$new'
        WHERE id='$id'");

        $success = "Password Updated Successfully";

    }else{

        $error = "Current Password Incorrect";

    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f1f5f9;
    font-family:'Poppins',sans-serif;
}

.password-box{
    max-width:500px;
    margin:auto;
    margin-top:100px;
}

.card{
    border:none;
    border-radius:18px;
}

</style>

</head>

<body>

<div class="container">

<div class="password-box">

<div class="card shadow">

<div class="card-body">

<h3 class="mb-4">
Change Password
</h3>

<?php if(isset($success)){ ?>

<div class="alert alert-success">
<?php echo $success; ?>
</div>

<?php } ?>

<?php if(isset($error)){ ?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>

<?php } ?>

<?php if(isset($success)){ ?>

<div class="alert alert-success alert-dismissible fade show">

<?php echo $success; ?>

<button type="button"
class="btn-close"
data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<?php if(isset($error)){ ?>

<div class="alert alert-danger alert-dismissible fade show">

<?php echo $error; ?>

<button type="button"
class="btn-close"
data-bs-dismiss="alert"></button>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>Current Password</label>

<input type="password"
       name="current_password"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label>New Password</label>

<input type="password"
       name="new_password"
       class="form-control"
       required>

</div>

<button type="submit"
        name="change_password"
        class="btn btn-primary">

Update Password

</button>

<a href="profile.php"
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