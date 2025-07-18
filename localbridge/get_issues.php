<?php
$conn = new mysqli("localhost", "root", "root", "localbridge");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM issues ORDER BY created_at DESC";
$result = $conn->query($sql);

$issues = [];
while ($row = $result->fetch_assoc()) {
  $issues[] = [
    'title' => $row['title'],
    'category' => $row['category'],
    'description' => $row['description'],
    'image' => $row['image'],
    'created_at' => $row['created_at'],
    'reporter_name' => $row['reporter_name'] ?? 'Anonymous'
  ];
}

header('Content-Type: application/json');
echo json_encode($issues);
$conn->close();
?>
