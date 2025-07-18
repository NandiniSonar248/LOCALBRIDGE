

<?php
// (Optional) Handle form submission here or on submit_issue.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Report an Issue - LocalBridge</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="styles.css" />
 
  <style>
    /* Additional form-specific styles, consistent with signup styling */

    /* Form box similar to signup */
    .container{
       margin: 20px auto;
      
    }
    .form-box {
      background: #fff;
      margin: 40px auto;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      width: 470px;
      box-sizing: border-box;
    }


    /* Logo & Title */
    .logo {
      font-weight: 700;
      font-size: 22px;
      color: #2558f1;
      text-align: center;
      margin-bottom: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
    }
    .logo svg {
      width: 24px;
      height: 24px;
      fill: #2558f1;
    }

    h2 {
      text-align: center;
      margin-bottom: 10px;
      font-weight: 600;
      color: #222;
    }
  

    p.subtitle, p.description {
      font-size: 14px;
      text-align: center;
      color: #555;
      margin-bottom: 25px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: #222;
      font-size: 14px;
    }

    input[type="text"],
    select,
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px 14px;
      margin-bottom: 18px;
      border-radius: 8px;
      border: 1.5px solid #ddd;
      font-size: 14px;
      font-family: inherit;
      transition: border-color 0.3s ease;
      box-sizing: border-box;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus,
    input[type="file"]:focus {
      border-color: #2558f1;
      outline: none;
    }

    textarea {
      min-height: 90px;
      resize: vertical;
    }

    /* Submit Button */
    .btn-primary {
      background-color: #2558f1;
      color: white;
      border: none;
      padding: 14px 0;
      font-weight: 600;
      font-size: 16px;
      border-radius: 10px;
      width: 100%;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #1b43c3;
    }
  </style>
</head>
<body>

  <!-- Navbar copied from signup.php -->
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
    <!-- <div class="navbar-right">
      <a href="signin.html"><button class="btn-outline">Sign in</button></a>
      <a href="signup.php"><button class="btn-primary">Sign up</button></a>
    </div> -->
  </nav>

  <div class="container">
    <!-- <div class="logo">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm0-4h2V3H3v2zm4 12h2v-2H7v2zm0-4h2v-2H7v2zm0-4h2V7H7v2zm0-4h2V3H7v2zm4 12h2v-2h-2v2zm0-4h2v-2h-2v2zm0-4h2V7h-2v2zm0-4h2V3h-2v2zm4 12h2v-2h-2v2zm0-4h2v-2h-2v2zm0-4h2V7h-2v2zm0-4h2V3h-2v2z"/>
      </svg>
      LocalBridge
    </div> -->
     <div class="container">
    <div class="logo">
      <img src="logo.png" alt="LocalBridge Logo" />
      <span class="brand">LocalBridge</span>
    </div>

    <div class="form-box">
      <h2>Report an Issue</h2>
      <p class="description">Help improve your community by reporting issues</p>
      

      <form action="submit_issue.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <label for="title">Issue Title</label>
        <input type="text" id="title" name="title" required />

        <label for="description">Issue Description</label>
        <textarea id="description" name="description" placeholder="Describe the issue in detail..." required></textarea>

        <label for="category">Category</label>
        <select id="category" name="category" required>
          <option value="" disabled selected>Select category</option>
          <option value="Roads">Roads</option>
          <option value="Sanitation">Sanitation</option>
          <option value="Water">Water</option>
          <option value="Electricity">Electricity</option>
          <option value="Other">Other</option>
        </select>

        <label for="photo">Upload Photo (optional)</label>
        <input type="file" id="photo" name="photo" accept="image/*" />

        <button type="submit" class="btn-primary">Submit Issue</button>
      </form>
    </div>
  </div>

</body>
</html>
