<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

<title>Profile</title>

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

<div class="card shadow">

<div class="card-body text-center">

<i class="fa-solid fa-circle-user profile-icon mb-4"></i>

<h2><?php echo $user['name']; ?></h2>

<p class="text-muted">
<?php echo $user['email']; ?>
</p>

<span class="badge bg-dark p-2">
<?php echo $user['role']; ?>
</span>

<div class="mt-4">

<a href="change_password.php"
class="btn btn-primary">

Change Password

</a>

</div>

</div>

</div>

</div>


</body>
</html>