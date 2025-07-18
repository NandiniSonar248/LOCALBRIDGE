<?php
include 'includes/db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    echo "Thank you for your feedback!";
}
?>

<form method="post">
    <label>Name:</label><input type="text" name="name" required><br>
    <label>Email:</label><input type="email" name="email" required><br>
    <label>Message:</label><textarea name="message" required></textarea><br>
    <button type="submit" name="submit">Send Feedback</button>
</form>