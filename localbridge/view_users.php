<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "localbridge");
$result = $conn->query("SELECT * FROM users");

echo "<h2>Registered Users</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>" . $row['username'] . " (" . $row['email'] . ")</li>";
}
echo "</ul><a href='admin_dashboard.php'>Back</a>";
?>
