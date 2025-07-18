<?php
$conn = new mysqli("localhost", "root", "root", "localbridge");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

echo "✅ Connected to: " . $conn->host_info . "<br>";

$result = $conn->query("SELECT DATABASE() as db");
$row = $result->fetch_assoc();
echo "📦 Current Database: " . $row['db'] . "<br>";

$result = $conn->query("SELECT COUNT(*) as total FROM issues");
$row = $result->fetch_assoc();
echo "📊 Total Issues: " . $row['total'];

$conn->close();
?>
