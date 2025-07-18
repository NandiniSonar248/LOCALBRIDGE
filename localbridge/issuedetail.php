<?php
$id = $_GET['id'] ?? 0;
$conn = new mysqli("localhost", "root", "root", "localbridge");
$res = $conn->query("SELECT * FROM issues WHERE id = $id LIMIT 1");
$data = $res->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Issue Detail</title>
</head>
<body>
  <h1><?= $data['title'] ?></h1>
  <img src="<?= $data['image'] ?>" width="400" />
  <p><strong>Category:</strong> <?= $data['category'] ?></p>
  <p><strong>Description:</strong> <?= $data['description'] ?></p>
  <p><strong>Status:</strong> <?= $data['status'] ?></p>
  <p><strong>Location:</strong> <?= $data['location'] ?></p>
  <p><strong>Date:</strong> <?= $data['date'] ?></p>
  <p><strong>Upvotes:</strong> <?= $data['upvotes'] ?></p>
</body>
</html>
