<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, Admin <?php echo $_SESSION['admin_username']; ?>!</h2>
    <p><a href="view_users.php">View Users</a></p>
    <p><a href="view_issues.php">View Reported Issues</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
