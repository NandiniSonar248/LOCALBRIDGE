<?php
// Optional backend handling can go in submit_issue.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Report an Issue | LocalBridge</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --bg: #f3f4f6;
      --text: #111827;
      --white: #fff;
      --shadow: 0 10px 25px rgba(0,0,0,0.08);
      --transition: 0.3s ease-in-out;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    /* ===== NAVBAR ===== */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #fff;
      padding: 1rem 2rem;
      box-shadow: var(--shadow);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar-left img {
      height: 32px;
    }

    .logo-text {
      font-weight: bold;
      font-size: 1.4rem;
      color: var(--primary);
    }

    .navbar-menu {
      list-style: none;
      display: flex;
      gap: 1.5rem;
    }

    .navbar-menu a {
      text-decoration: none;
      color: var(--text);
      font-weight: 500;
      position: relative;
      padding-bottom: 2px;
      transition: var(--transition);
    }

    .navbar-menu a:hover,
    .navbar-menu a.active {
      color: var(--primary);
    }

    .navbar-menu a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      background: var(--primary);
      left: 0;
      bottom: 0;
      transition: var(--transition);
    }

    .navbar-menu a:hover::after,
    .navbar-menu a.active::after {
      width: 100%;
    }

    /* ===== FORM CONTAINER ===== */
    .container {
      max-width: 550px;
      background: var(--white);
      margin: 50px auto;
      padding: 40px;
      border-radius: 12px;
      box-shadow: var(--shadow);
    }

    .form-header {
      text-align: center;
      margin-bottom: 25px;
    }

    .form-header h2 {
      font-size: 26px;
      font-weight: 700;
      background: linear-gradient(90deg, #2563eb, #1e40af);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: floatText 3s ease-in-out infinite alternate;
    }

    @keyframes floatText {
      from { transform: translateY(0px); }
      to { transform: translateY(-2px); }
    }

    .form-header p {
      color: #666;
      font-size: 14px;
    }

    label {
      font-weight: 600;
      margin-bottom: 6px;
      display: block;
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
      border: 1.5px solid #d1d5db;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: var(--primary);
      outline: none;
    }

    textarea {
      min-height: 100px;
      resize: vertical;
    }

    .btn-primary {
      background: var(--primary);
      color: white;
      padding: 12px 0;
      width: 100%;
      font-size: 15px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background var(--transition);
    }

    .btn-primary:hover {
      background: var(--primary-dark);
    }

    .btn-location {
      display: inline-block;
      font-size: 13px;
      background: #e0e7ff;
      color: #1e40af;
      padding: 6px 10px;
      border: none;
      border-radius: 6px;
      margin-bottom: 18px;
      cursor: pointer;
      transition: background var(--transition);
    }

    .btn-location:hover {
      background: #c7d2fe;
    }

    @media (max-width: 600px) {
      .container {
        margin: 20px 10px;
        padding: 30px;
      }
    }
  </style>
</head>
<body>

  <!-- ===== Navbar ===== -->
  <nav class="navbar">
    <div class="navbar-left">
      <img src="logo.png" alt="LocalBridge Logo">
      <span class="logo-text">LocalBridge</span>
    </div>
    <ul class="navbar-menu">
      <li><a href="index.html">Home</a></li>
      <li><a href="issues.html">Issues</a></li>
      <li><a href="reportIssue.php" class="active">Report Issue</a></li>
      <li><a href="about.html">About</a></li>
    </ul>
  </nav>

  <!-- ===== Form Section ===== -->
  <div class="container">
    <div class="form-header">
      <h2>📣 Report an Issue</h2>
      <p>Help your community by reporting problems you observe.</p>
    </div>

    <form action="submit_issue.php" method="POST" enctype="multipart/form-data" autocomplete="off">
      <label for="title">Issue Title</label>
      <input type="text" id="title" name="title" required>

      <label for="description">Issue Description</label>
      <textarea id="description" name="description" required placeholder="Describe the issue..."></textarea>

      <label for="category">Category</label>
      <select id="category" name="category" required>
        <option value="" disabled selected>Select category</option>
        <option value="Roads">Roads</option>
        <option value="Sanitation">Sanitation</option>
        <option value="Water">Water</option>
        <option value="Electricity">Electricity</option>
        <option value="Other">Other</option>
      </select>

      <label for="location">Location</label>
      <input type="text" id="location" name="location" placeholder="Enter or auto-detect your location" />
      <button type="button" class="btn-location" onclick="detectLocation()">📍 Detect My Location</button>

      <label for="photo">Upload Photo (optional)</label>
      <input type="file" id="photo" name="photo" accept="image/*">

      <button type="submit" class="btn-primary">Submit Issue</button>
    </form>
  </div>

  <!-- ===== JavaScript for Location Detection ===== -->
  <script>
    function detectLocation() {
      const input = document.getElementById("location");
      if (!navigator.geolocation) {
        alert("Geolocation not supported.");
        return;
      }

      input.placeholder = "Detecting your location...";
      navigator.geolocation.getCurrentPosition(success, error);

      function success(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
          .then(res => res.json())
          .then(data => {
            input.value = data.display_name || `${lat}, ${lon}`;
          })
          .catch(() => {
            input.value = `${lat}, ${lon}`;
          });
      }

      function error() {
        alert("Could not retrieve location.");
        input.placeholder = "Enter your location manually";
      }
    }
  </script>
</body>
</html>
