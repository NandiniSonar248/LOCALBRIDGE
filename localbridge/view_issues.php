<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "root", "localbridge");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Fetch all issues
$sql = "SELECT * FROM issues ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submitted Issues</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .issue { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
        .issue img { max-width: 200px; display: block; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>🗂️ All Submitted Issues</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="issue">
                <h2>📌 <?= htmlspecialchars($row['title']) ?></h2>
                <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
                <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                <?php if (!empty($row['image'])): ?>
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Issue Image">
                <?php endif; ?>
                <p><small>🕒 Submitted at: <?= $row['created_at'] ?></small></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No issues submitted yet.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
