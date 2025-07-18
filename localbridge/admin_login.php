<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "localbridge";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

$sql = "SELECT * FROM admin WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    header("Location: admin_dashboard.php");
} else {
    echo "Invalid login. <a href='admin_login.html'>Try again</a>";
}
?>
