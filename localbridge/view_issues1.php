<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "localbridge");
$result = $conn->query("SELECT * FROM issues");

echo "<h2>Reported Issues</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li><strong>" . $row['title'] . ":</strong> " . $row['description'] . " (" . $row['location'] . ")</li>";
}
echo "</ul><a href='admin_dashboard.php'>Back</a>";
?>