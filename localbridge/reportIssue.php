<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Issue - LocalBridge</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="styles.css"> <!-- If you have a separate CSS file -->
  <style>
    :root {
  --brand: #2563eb;
  --brand-hover: #174bb3;
  --bg: #f6f8fa;
  --card: #fff;
  --border: #e5e7eb;
  --shadow: 0 2px 12px rgba(33,102,230,0.06);
  --radius: 12px;
  --input-bg: #f9fafb;
  --input-border: #e5e7eb;
  --input-focus: #2563eb;
  --text-muted: #888;
}

body {
  margin: 0;
  font-family: 'Segoe UI', Arial, sans-serif;
  background: var(--bg);
  color: #222;
}

/* NAVBAR */
.navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: var(--card);
  padding: 0.7rem 2rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.navbar-logo {
  display: flex;
  align-items: center;
  font-weight: bold;
  font-size: 1.3rem;
  color: var(--brand);
  text-decoration: none;
}
.navbar-logo svg {
  margin-right: 0.5rem;
  width: 2rem;
  height: 2rem;
  vertical-align: middle;
}
.navbar-links {
  list-style: none;
  display: flex;
  gap: 2rem;
  margin: 0;
  padding: 0;
}
.navbar-links a {
  text-decoration: none;
  color: #222;
  font-weight: 500;
  border-bottom: 2px solid transparent;
  padding-bottom: 2px;
  transition: color 0.2s, border 0.2s;
}
.navbar-links a.active,
.navbar-links a:hover {
  color: var(--brand);
  border-bottom: 2px solid var(--brand);
}
.navbar-actions {
  display: flex;
  gap: 0.7rem;
  align-items: center;
}
.btn-primary, .btn-outline {
  padding: 0.45rem 1.1rem;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-weight: 500;
  font-size: 1rem;
  transition: background 0.2s, color 0.2s, border 0.2s;
}
.btn-primary {
  background: var(--brand);
  color: #fff;
  border: 1.5px solid var(--brand);
}
.btn-primary:hover {
  background: var(--brand-hover);
  border-color: var(--brand-hover);
}
.btn-outline {
  background: #fff;
  color: #222;
  border: 1.5px solid var(--border);
}
.btn-outline:hover {
  background: #f3f4f6;
  color: var(--brand);
  border-color: var(--brand);
}
.notif-icon {
  position: relative;
  font-size: 1.5rem;
  color: #222;
  cursor: pointer;
  margin-right: 0.2em;
}
.notif-dot {
  position: absolute;
  top: 2px; right: 2px;
  width: 10px; height: 10px;
  background: #ef4444;
  border-radius: 50%;
  border: 2px solid #fff;
}
.profile-pic {
  width: 36px; height: 36px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #fff;
  box-shadow: 0 1px 6px #e0e4ea;
  margin-left: 1.2em;
}
.profile-name {
  margin-left: 0.5em;
  font-weight: 500;
  color: #222;
}

/* MAIN CONTENT */
.main-content {
  min-height: 60vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: var(--bg);
}
.report-title {
  font-size: 2.2rem;
  font-weight: 700;
  margin-top: 2.2rem;
  margin-bottom: 0.3em;
}
.report-desc {
  color: var(--text-muted);
  margin-bottom: 2.5em;
  font-size: 1.1em;
}
.report-card {
  background: var(--card);
  border-radius: 16px;
  box-shadow: var(--shadow);
  padding: 2.5em 2em 2em 2em;
  width: 100%;
  max-width: 650px;
  margin-bottom: 3em;
}
.report-group { margin-bottom: 1.5em; }
.report-label {
  display: block;
  font-weight: 600;
  margin-bottom: 0.5em;
  color: #222;
}
.report-input, .report-select, .report-textarea {
  width: 100%;
  padding: 1em 1em;
  border-radius: 7px;
  border: 1.5px solid var(--input-border);
  font-size: 1.08em;
  background: var(--input-bg);
  color: #222;
  margin-bottom: 0.2em;
  transition: border 0.2s;
}
.report-input:focus, .report-select:focus, .report-textarea:focus {
  outline: none;
  border-color: var(--input-focus);
  background: #fff;
}
.report-textarea { min-height: 90px; resize: vertical; }
.report-photo-label { font-weight: 600; margin-bottom: 0.7em; display:block; }
.photo-upload-area {
  border: 2px dashed var(--input-border);
  border-radius: 10px;
  background: var(--input-bg);
  padding: 2em 1em;
  text-align: center;
  color: var(--text-muted);
  margin-bottom: 1.5em;
  cursor: pointer;
  transition: border 0.2s;
}
.photo-upload-area.dragover { border-color: var(--input-focus); background: #f1f6fd; }
.photo-upload-area input { display: none; }
.photo-upload-area svg { font-size: 2.3em; color: var(--brand); margin-bottom: 0.3em; }
.photo-upload-area .photo-upload-text { margin-top: 0.5em; }
.photo-upload-area .photo-upload-text a, .photo-upload-area .photo-upload-text span {
  color: var(--brand); text-decoration: underline; cursor: pointer;
}
.photo-preview {
  margin-top: 1em;
  display: flex;
  flex-wrap: wrap;
  gap: 1em;
  justify-content: center;
}
.photo-thumb {
  width: 70px; height: 70px; object-fit: cover; border-radius: 8px; border: 1px solid var(--input-border);
}
.report-actions {
  display: flex;
  justify-content: flex-end;
  gap: 1em;
  margin-top: 2.5em;
}
.btn-cancel {
  background: #fff;
  color: #222;
  border: 1.5px solid var(--input-border);
  border-radius: 6px;
  padding: 0.7em 2em;
  font-weight: 500;
  font-size: 1em;
  cursor: pointer;
  transition: background 0.2s, color 0.2s, border 0.2s;
}
.btn-cancel:hover {
  background: #f3f4f6;
  color: var(--brand);
  border-color: var(--brand);
}
.btn-submit {
  background: var(--brand);
  color: #fff;
  border-radius: 6px;
  padding: 0.7em 2em;
  font-weight: 600;
  font-size: 1em;
  border: none;
  cursor: pointer;
  transition: background 0.2s;
}
.btn-submit:hover { background: var(--brand-hover); }

/* AUTH CARD */
.auth-main {
  min-height: 40vh;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding: 3rem 1rem 2rem 1rem;
}
.auth-card {
  background: var(--card);
  border-radius: 16px;
  box-shadow: var(--shadow);
  padding: 2.5rem 2.5rem 2rem 2.5rem;
  max-width: 520px;
  width: 100%;
  margin-top: 2rem;
  text-align: center;
}
.auth-card h2 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1.2rem;
}
.auth-card p {
  color: #333;
  margin-bottom: 2rem;
}
.auth-actions {
  display: flex;
  justify-content: center;
  gap: 1rem;
}

/* FOOTER */
.footer {
  display: flex;
  justify-content: space-between;
  background: var(--bg);
  padding: 2.5rem 3rem 2rem 3rem;
  border-top: 1px solid #e0e4ea;
  flex-wrap: wrap;
  gap: 2rem;
}
.footer-col {
  min-width: 200px;
  max-width: 320px;
}
.footer-logo {
  display: flex;
  align-items: center;
  font-weight: bold;
  font-size: 1.2rem;
  color: var(--brand);
  margin-bottom: 0.6rem;
  text-decoration: none;
}
.footer-logo svg {
  margin-right: 0.5rem;
  width: 1.7rem;
  height: 1.7rem;
  vertical-align: middle;
}
.footer-col h4 {
  margin-bottom: 0.5rem;
  color: #222;
  font-size: 1.05rem;
  font-weight: 600;
  letter-spacing: 0.5px;
}
.footer-col ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-col ul li {
  margin-bottom: 0.5rem;
}
.footer-col ul li a {
  text-decoration: none;
  color: var(--brand);
  transition: color 0.2s;
}
.footer-col ul li a:hover {
  color: var(--brand-hover);
}
.footer-icons {
  margin-top: 1rem;
  display: flex;
  gap: 1.2rem;
  font-size: 1.25rem;
  color: var(--brand);
}
.footer-bottom {
  text-align: center;
  color: #888;
  font-size: 0.97rem;
  padding: 1.2rem 0 1.2rem 0;
  background: var(--bg);
  border-top: 1px solid #e0e4ea;
}
@media (max-width: 900px) {
  .footer {
    flex-direction: column;
    align-items: center;
    padding: 2rem 1rem;
  }
  .footer-col {
    width: 95%;
    margin-bottom: 1.5rem;
  }
  .report-card, .auth-card {
    padding: 2rem 1rem;
  }
}

  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <a class="navbar-logo" href="index.html">
      <svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="3" width="7" height="7" rx="1.5"/>
        <rect x="14" y="3" width="7" height="7" rx="1.5"/>
        <rect x="3" y="14" width="7" height="7" rx="1.5"/>
        <rect x="14" y="14" width="7" height="7" rx="1.5"/>
      </svg>
      LocalBridge
    </a>
    <ul class="navbar-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="issues.html">Issues</a></li>
      <li><a href="report.html" class="active">Report Issue</a></li>
      <li><a href="about.html">About</a></li>
    </ul>
    <div class="navbar-actions" id="navbarActions"></div>
  </nav>

  <!-- Main Content -->
  <main id="mainContent"></main>

  <!-- Footer -->
  <footer class="footer">
    <!-- ... your footer ... -->
    <div class="footer-col">
      <a class="footer-logo" href="index.html">
        <svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24">
          <rect x="3" y="3" width="7" height="7" rx="1.5"/>
          <rect x="14" y="3" width="7" height="7" rx="1.5"/>
          <rect x="3" y="14" width="7" height="7" rx="1.5"/>
          <rect x="14" y="14" width="7" height="7" rx="1.5"/>
        </svg>
        LocalBridge
      </a>
      <p>Connecting communities to solve local issues. Report, track,<br>and resolve civic problems together.</p>
      <div class="footer-icons">
        <span title="Feedback">🔔</span>
        <span title="Email">✉️</span>
        <span title="Location">📍</span>
      </div>
    </div>
    <!-- ...rest of your footer... -->
  </footer>
  <div class="footer-bottom">
    © 2025 LocalBridge. All rights reserved.
  </div>
  <script>
    // Simulated user profile
    const userProfile = {
      name: "fuwi",
      avatar: "https://randomuser.me/api/portraits/women/44.jpg"
    };

    function isSignedIn() {
  return localStorage.getItem('isSignedIn') === 'true';
}
function getProfile() {
  return {
    name: localStorage.getItem('username') || 'User',
    avatar: localStorage.getItem('avatar') || 'https://randomuser.me/api/portraits/women/44.jpg'
  };
}
function renderNavbarActions() {
  const nav = document.getElementById('navbarActions');
  if (isSignedIn()) {
    const profile = getProfile();
    nav.innerHTML = `
      <span class="notif-icon" title="Notifications">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        <span class="notif-dot"></span>
      </span>
      <img src="${profile.avatar}" class="profile-pic" alt="profile">
      <span class="profile-name">${profile.name}</span>
      <button class="btn-outline" onclick="signOut()" style="margin-left:1em;">Sign out</button>
    `;
  } else {
    nav.innerHTML = `
      <button class="btn-outline" onclick="window.location.href='signin.html'">Sign in</button>
      <button class="btn-primary" onclick="window.location.href='signup.html'">Sign up</button>
    `;
  }
}
function renderMainContent() {
  const main = document.getElementById('mainContent');
  if (!isSignedIn()) {
    main.innerHTML = `
      <div class="auth-main">
        <div class="auth-card">
          <h2>Authentication Required</h2>
          <p>You need to be logged in to report an issue. Please sign in to continue.</p>
          <div class="auth-actions">
            <a href="issues.html"><button class="btn-outline">Back to Issues</button></a>
            
            <a href="signin.php?redirect=report_issue.php"><button class="btn-primary">Sign In</button></a>

          </div>
        </div>
      </div>
    `;
  } else {
    main.innerHTML = `
      <div class="main-content">
        <div class="report-title">Report an Issue</div>
        <div class="report-desc">Help improve your community by reporting local issues</div>
        <form class="report-card" id="reportForm" autocomplete="off">
          <div class="report-group">
            <label class="report-label" for="issueTitle">Issue Title *</label>
            <input type="text" class="report-input" id="issueTitle" name="title" placeholder="E.g., Pothole on Main Street" required>
          </div>
          <div class="report-group">
            <label class="report-label" for="issueCategory">Category *</label>
            <select class="report-select" id="issueCategory" name="category" required>
              <option value="">Select a category</option>
              <option>Roads &amp; Sidewalks</option>
              <option>Garbage &amp; Waste</option>
              <option>Street Lighting</option>
              <option>Public Spaces</option>
              <option>Other</option>
            </select>
          </div>
          <div class="report-group">
            <label class="report-label" for="issueLocation">Location *</label>
            <input type="text" class="report-input" id="issueLocation" name="location" placeholder="&#128205; Enter address or location description" required>
          </div>
          <div class="report-group">
            <label class="report-label" for="issueDesc">Description *</label>
            <textarea class="report-textarea" id="issueDesc" name="description" placeholder="Please provide details about the issue..." required></textarea>
          </div>
          <div class="report-group">
            <label class="report-photo-label">Add Photo</label>
            <div class="photo-upload-area" id="photoUploadArea">
              <input type="file" id="photoInput" accept="image/png, image/jpeg" multiple>
              <div>
                <svg width="48" height="48" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M12 19V6M5 12l7-7 7 7"/>
                </svg>
              </div>
              <div class="photo-upload-text">
                <span style="color:#2563eb;cursor:pointer;text-decoration:underline;" onclick="document.getElementById('photoInput').click()">Upload a file</span>
                or drag and drop<br>
                <span style="color:#888;font-size:0.97em;">PNG, JPG up to 5MB</span>
              </div>
              <div class="photo-preview" id="photoPreview"></div>
            </div>
          </div>
          <div class="report-actions">
            <button class="btn-cancel" type="button" onclick="window.location.href='issues.html'">Cancel</button>
            <button class="btn-submit" type="submit">Submit Report</button>
          </div>
        </form>
      </div>
    `;
    // Photo upload preview logic
    const photoInput = document.getElementById('photoInput');
    const photoArea = document.getElementById('photoUploadArea');
    const photoPreview = document.getElementById('photoPreview');
    photoArea.addEventListener('dragover', e => {
      e.preventDefault();
      photoArea.classList.add('dragover');
    });
    photoArea.addEventListener('dragleave', e => {
      e.preventDefault();
      photoArea.classList.remove('dragover');
    });
    photoArea.addEventListener('drop', e => {
      e.preventDefault();
      photoArea.classList.remove('dragover');
      photoInput.files = e.dataTransfer.files;
      showPhotoPreview(photoInput.files);
    });
    photoInput.addEventListener('change', () => {
      showPhotoPreview(photoInput.files);
    });
    function showPhotoPreview(files) {
      photoPreview.innerHTML = '';
      Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'photo-thumb';
            photoPreview.appendChild(img);
          };
          reader.readAsDataURL(file);
        }
      });
    }
    document.getElementById('reportForm').onsubmit = function(e) {
      e.preventDefault();
      alert('Report submitted! (Demo only)');
      window.location.href = 'issues.html';
    };
  }
}
function signOut() {
  localStorage.removeItem('isSignedIn');
  localStorage.removeItem('username');
  localStorage.removeItem('avatar');
  renderNavbarActions();
  renderMainContent();
}
renderNavbarActions();
renderMainContent();

         
  </script>
</body>
</html>
