<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "root", "localbridge");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Correct column name: name instead of fullname
    $sql = "SELECT id, name, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "❌ Invalid password.";
        }
    } else {
        $error = "❌ No user found with this email.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Sign In - LocalBridge</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="styles.css" />
  <style>
    .error-message {
      color: #721c24;
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
      padding: 10px 15px;
      margin-bottom: 15px;
      border-radius: 6px;
      text-align: center;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="navbar-left">
      <img src="logo.png" alt="LocalBridge Logo" />
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
    <div class="logo">
      <img src="logo.png" alt="LocalBridge Logo" />
      <span class="brand">LocalBridge</span>
    </div>
    <div class="form-box">
      <h2>Sign in to LocalBridge</h2>
      <p class="subtitle">Enter your details to access your account</p>

      <?php if (!empty($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <label for="email">Email</label>
        <div class="input-group">
          <i class="fa-regular fa-envelope"></i>
          <input type="email" name="email" id="email" placeholder="Email" required />
        </div>

        <div class="label-row">
          <label for="password">Password</label>
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>
        <div class="input-group">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" id="password" placeholder="Password" required />
        </div>

        <button type="submit" class="btn">Sign in</button>
      </form>

      <div class="signup-link">
        Don't have an account? <a href="signup.php">Sign up</a>
      </div>

      <hr class="divider" />
      <div class="demo-info">
        <div>For demo purposes:</div>
        <div>Email: <span class="demo-email">john@example.com</span></div>
        <div>Password: <span class="demo-password">password</span></div>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
