<div class="sidebar">

<h2>Bug Tracker</h2>

<a href="dashboard.php">
<i class="fa-solid fa-house me-2"></i> Dashboard
</a>

<?php if($_SESSION['user_role']=="admin"){ ?>

<a href="projects.php">
<i class="fa-solid fa-folder me-2"></i> Projects
</a>

<?php } ?>

<?php if($_SESSION['user_role']!="developer"){ ?>

<a href="bugs.php">
<i class="fa-solid fa-bug me-2"></i> Bugs
</a>

<?php } ?>

<?php if($_SESSION['user_role']!="tester"){ ?>

<a href="tasks.php">
<i class="fa-solid fa-list-check me-2"></i> Tasks
</a>

<?php } ?>

<a href="profile.php">
<i class="fa-solid fa-user me-2"></i> Profile
</a>

<a href="activity_logs.php">
<i class="fa-solid fa-clock-rotate-left me-2"></i> Activity Logs
</a>

<a href="logout.php">
<i class="fa-solid fa-right-from-bracket me-2"></i> Logout
</a>

</div>