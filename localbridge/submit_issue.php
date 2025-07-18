<?php
// 1. Connect to DB
$servername = "localhost";
$username = "root";
$password = "root";  // Usually blank for XAMPP
$dbname = "localbridge";

$conn = new mysqli($servername, $username, $password, $dbname);

// 2. Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// 3. Get form data safely
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$category = $_POST['category'] ?? '';

// 4. Handle file upload
$image_path = "";
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = basename($_FILES['photo']['name']);
    $targetPath = $uploadDir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
        $image_path = $targetPath;
    } else {
        echo "⚠️ Failed to move uploaded file.<br>";
    }
}

// 5. Insert into DB using correct column 'image'
$sql = "INSERT INTO issues (title, description, category, image) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("❌ SQL Prepare Failed: " . $conn->error);
}

$stmt->bind_param("ssss", $title, $description, $category, $image_path);
$success = $stmt->execute();

$stmt->close();
$conn->close();

// 6. Show popup & redirect accordingly
if ($success) {
    echo "<script>
        alert('✅ Issue submitted successfully!');
        window.location.href = 'index.html';
    </script>";
} else {
    echo "<script>
        alert('❌ Error submitting issue. Please try again.');
        window.location.href = 'report_issueform.php';
    </script>";
}
?>
