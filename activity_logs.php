<?php
session_start();
include 'config/database.php';

$query = "SELECT activity_logs.*, users.name
FROM activity_logs
LEFT JOIN users
ON activity_logs.user_id = users.id
ORDER BY activity_logs.id DESC";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Activity Logs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background:#f1f5f9;
    font-family:'Poppins',sans-serif;
}

.main-content{
    padding:40px;
}

.card{
    border:none;
    border-radius:18px;
}

</style>

</head>

<body>

<div class="main-content">

<div class="card shadow">

<div class="card-header bg-dark text-white">
Activity Logs
</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th>User</th>
<th>Activity</th>
<th>Date</th>

</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['activity']; ?></td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>