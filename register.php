<?php
include 'config/database.php';

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $query = "INSERT INTO users(name,email,password,role)
              VALUES('$name','$email','$password','$role')";

    mysqli_query($conn,$query);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header text-center">
<h3>Register</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Role</label>

<select name="role" class="form-control">

<option value="admin">Admin</option>
<option value="developer">Developer</option>
<option value="tester">Tester</option>

</select>

</div>

<button type="submit" name="register" class="btn btn-primary w-100">
Register
</button>

</form>

</div>
</div>
</div>
</div>
</div>

</body>
</html>