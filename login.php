<?php
session_start();
include 'config/database.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users 
              WHERE email='$email' 
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_role'] = $row['role'];

        header("Location: dashboard.php");

    } else {

        $error = "Invalid Email or Password";

    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.login-card{
    margin-top:100px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow login-card">

<div class="card-header text-center bg-dark text-white">
<h3>Login</h3>
</div>

<div class="card-body">

<?php if(isset($error)){ ?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>Email</label>

<input type="email"
       name="email"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label>Password</label>

<input type="password"
       name="password"
       class="form-control"
       required>

</div>

<button type="submit"
        name="login"
        class="btn btn-primary w-100">

Login

</button>

</form>

</div>
</div>
</div>
</div>
</div>

</body>
</html>