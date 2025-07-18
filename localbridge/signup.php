<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$username = "root";
$password = "root";
$database = "localbridge";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "❌ Passwords do not match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            $success = "✅ Registration successful! Redirecting to Sign In...";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'signin.php';
                }, 3000);
            </script>";
        } else {
            $error = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LocalBridge - Create an account</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .message-box {
            margin: 15px auto;
            padding: 12px 20px;
            width: 80%;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            transition: all 0.4s ease;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="logo.png" alt="LocalBridge Logo">
            <span class="logo-text">LocalBridge</span>
        </div>
        <ul class="navbar-menu">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="issues.html">Issues</a></li>
            <li><a href="reportIssue.php">Report Issue</a></li>
            <li><a href="about.html">About</a></li>
        </ul>
        <div class="navbar-right">
            <a href="signin.php"><button class="btn-outline">Sign in</button></a>
            <a href="signup.php"><button class="btn-primary">Sign up</button></a>
        </div>
    </nav>

    <div class="container">
        <div class="form-box">
            <h2>Create an account</h2>
            <p class="subtitle">Join LocalBridge to report and track community issues</p>

            <?php if (!empty($error)): ?>
                <div class="message-box error"><?= $error ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="message-box success"><?= $success ?></div>
            <?php endif; ?>

            <form id="registerForm" method="POST" action="" autocomplete="off">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" minlength="8" required>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>

                <button type="submit" class="btn">Create Account</button>
            </form>

            <div class="signin-link">
                Already have an account? <a href="signin.php">Sign in</a>
            </div>
        </div>
    </div>
</body>
</html>
