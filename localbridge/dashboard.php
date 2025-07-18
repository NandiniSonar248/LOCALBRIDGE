<?php
session_start();

// Redirect to signin if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>LocalBridge Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar">
    <div class="navbar-left">
      <img src="logo.png" alt="LocalBridge Logo" />
      <span class="logo-text">LocalBridge</span>
    </div>
    <ul class="navbar-menu">
      <li><a href="#" class="active">Home</a></li>
      <li><a href="issues.html">Issues</a></li>
      <li><a href="report_issue.html">Report Issue</a></li>
      <li><a href="about.html">About</a></li>
    </ul>
    <div class="navbar-right">
      <!-- Show Sign out button only -->
      <form method="post" action="logout.php" style="display:inline;">
        <button type="submit" class="btn-outline">Sign out</button>
      </form>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <h1>Report and resolve local issues<br>together</h1>
    <p>LocalBridge connects residents with local authorities to report, track, and resolve community issues.</p>
    <div class="hero-actions">
      <a href="report_issueform.php"><button class="btn-white-outline">Report an Issue</button></a>
      <a href="issues.html"><button class="btn-white-outline">View Issues</button></a>
    </div>
  </section>

  <!-- How It Works -->
  <section class="how-it-works">
    <h2>How It Works</h2>
    <p>LocalBridge makes it easy to report issues in your community and track their resolution</p>
    <div class="features">
      <div class="feature">
        <div class="feature-icon"><span class="icon-bg">🔍</span></div>
        <h3>Report an Issue</h3>
        <p>Submit details about local problems such as potholes, broken streetlights, or garbage overflow.</p>
      </div>
      <div class="feature">
        <div class="feature-icon"><span class="icon-bg">👁️</span></div>
        <h3>Track Progress</h3>
        <p>Follow the status of your reports and get updates as issues are addressed by authorities.</p>
      </div>
      <div class="feature">
        <div class="feature-icon"><span class="icon-bg">👥</span></div>
        <h3>Community Engagement</h3>
        <p>Upvote important issues, add comments, and collaborate with neighbors to improve your area.</p>
      </div>
    </div>
  </section>

  <!-- Why Choose LocalBridge -->
  <section class="why-choose">
    <div class="why-img">
      <img src="https://images.pexels.com/photos/1181696/pexels-photo-1181696.jpeg?auto=compress&w=600" alt="Community Meeting" />
    </div>
    <div class="why-content">
      <h2>Why Choose LocalBridge?</h2>
      <ul>
        <li>
          <span class="why-icon">🔍</span>
          <div>
            <strong>Real-time Updates</strong>
            <p>Stay informed about the status of reported issues with immediate notifications.</p>
          </div>
        </li>
        <li>
          <span class="why-icon">👥</span>
          <div>
            <strong>Community-Powered</strong>
            <p>Collaborate with neighbors to highlight and address local concerns together.</p>
          </div>
        </li>
      </ul>
    </div>
  </section>

  <!-- Success Stories -->
  <section class="success-stories">
    <h2>Success Stories</h2>
    <p>See how LocalBridge has helped communities resolve everyday issues</p>
    <div class="stories">
      <div class="story-card">
        <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80" alt="Pothole Fixed" />
        <h3>Pothole Fixed in 48 Hours</h3>
        <p>After being reported by multiple residents and receiving 50+ upvotes, the city filled a dangerous pothole within two days.</p>
        <span class="story-location">Oak Street, Cityville</span>
      </div>
      <div class="story-card">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Improved Street Lighting" />
        <h3>Improved Street Lighting</h3>
        <p>Community members highlighted safety concerns in a poorly lit area, resulting in new streetlights being installed.</p>
        <span class="story-location">Maple Avenue, Townsville</span>
      </div>
      <div class="story-card">
        <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80" alt="Park Cleanup Initiative" />
        <h3>Park Cleanup Initiative</h3>
        <p>Reports of littering led to a community cleanup event supported by local authorities and businesses.</p>
        <span class="story-location">Central Park, Riverside</span>
      </div>
    </div>
    <button class="btn-outline wide">View All Success Stories</button>
  </section>

  <!-- Call to Action -->
  <section class="cta">
    <h2>Ready to improve your community?</h2>
    <p>Join LocalBridge today and start making a difference in your neighborhood.</p>
    <div class="cta-actions">
      <button class="btn-primary">Sign Up Now</button>
      <button class="btn-outline">Browse Issues</button>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-col">
      <div class="footer-logo">
        <img src="logo.png" alt="LocalBridge Logo" />
        <span class="logo-text">LocalBridge</span>
      </div>
      <p>Connecting communities to solve local issues. Report, track, and resolve civic problems together.</p>
    </div>
    <div class="footer-col">
      <h4>RESOURCES</h4>
      <ul>
        <li><a href="about.html">About Us</a></li>
        <li><a href="#">FAQ</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>LEGAL</h4>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
      </ul>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
