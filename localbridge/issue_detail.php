<?php
$conn = new mysqli("localhost", "root", "root", "localbridge");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$title = urldecode($_GET['title'] ?? '');
$stmt = $conn->prepare("SELECT * FROM issues WHERE title = ? LIMIT 1");
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();
$issue = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Issue Details | LocalBridge</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: Arial, sans-serif; background: #f7f9fb; margin: 0; padding: 0; transition: background 0.3s, color 0.3s; }
    .container { max-width: 900px; margin: 2rem auto; background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.07); transition: background 0.3s, color 0.3s; }
    h2 { margin-top: 0; }
    img { width: 100%; max-height: 320px; object-fit: cover; border-radius: 10px; margin-top: 1rem; }
    .meta { margin-top: 1rem; color: #555; }
    .meta span { display: inline-block; margin-right: 1.5rem; font-size: 0.95rem; }
    .back-link { display: inline-block; margin-top: 2rem; color: #2563eb; text-decoration: underline; }
    .vote-section { margin-top: 1.5rem; font-size: 1.3rem; }
    .vote-btn { cursor: pointer; border: none; background: none; font-size: 1.4rem; color: #2563eb; margin-right: 0.7rem; transition: transform 0.2s ease; }
    .vote-btn:hover { transform: scale(1.15); }
    #vote-count { font-weight: bold; margin: 0 0.7rem; }
    .comment-section { margin-top: 2rem; }
    textarea { width: 100%; padding: 0.7rem; font-size: 1rem; border-radius: 6px; border: 1px solid #ccc; resize: vertical; }
    button.comment-btn { margin-top: 0.7rem; padding: 0.6rem 1.2rem; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; }
    button.comment-btn:hover { background: #174ab6; }
    .comment-list { margin-top: 1.2rem; }
    .comment-item { background: #eef2ff; padding: 0.6rem; margin-bottom: 0.5rem; border-radius: 6px; font-size: 0.95rem; position: relative; }
    .comment-actions { float: right; font-size: 0.85rem; }
    .comment-actions button { margin-left: 0.4rem; border: none; background: none; color: #555; cursor: pointer; }
    #toggleDarkMode { float:right; margin-bottom: 1rem; background:#2563eb; color:#fff; padding:6px 12px; border:none; border-radius:6px; cursor:pointer; }

    /* Dark Mode Styles */
    body.dark-mode { background: #121212; color: #e0e0e0; }
    .container.dark-mode { background: #1e1e1e; color: #e0e0e0; }
    .comment-item.dark-mode { background: #2a2a2a; }
    .comment-actions button:hover { color: red; }
  </style>
</head>
<body>
<div class="container" id="mainContainer">
  <button id="toggleDarkMode">🌙 Toggle Dark Mode</button>
  <a href="issues.html" class="back-link">&larr; Back to issues</a>

  <div id="issueContent">
    <?php if ($issue): ?>
      <h2><?= htmlspecialchars($issue['title']) ?></h2>
      <img src="<?= htmlspecialchars($issue['image']) ?>" alt="Issue image" />
      <p><strong>Category:</strong> <?= htmlspecialchars($issue['category']) ?></p>
      <p><?= nl2br(htmlspecialchars($issue['description'])) ?></p>
      <div class="meta">
        <span><strong>Reported by:</strong> <?= htmlspecialchars($issue['reporter_name'] ?? 'Anonymous') ?></span>
        <span><strong>Reported on:</strong> <?= htmlspecialchars($issue['created_at']) ?></span>
      </div>
    <?php else: ?>
      <script>
        const staticIssues = [
          { title: "Large pothole on Main Street", category: "Roads", description: "There is a large pothole...", image: "pathole.jpg", reporter: "Nandini Sonar", date: "2025-05-15" },
          { title: "Overflowing garbage bin", category: "Sanitation", description: "Garbage bins near park...", image: "garbage.jpg", reporter: "Priya Marathe", date: "2025-06-02" }
        ];
        const titleParam = decodeURIComponent(new URLSearchParams(window.location.search).get("title") || "");
        const issue = staticIssues.find(i => i.title === titleParam);
        const div = document.getElementById("issueContent");

        if (issue) {
          div.innerHTML = `
            <h2>${issue.title}</h2>
            <img src="${issue.image}" alt="Issue image" />
            <p><strong>Category:</strong> ${issue.category}</p>
            <p>${issue.description}</p>
            <div class="meta">
              <span><strong>Reported by:</strong> ${issue.reporter}</span>
              <span><strong>Reported on:</strong> ${issue.date}</span>
            </div>
          `;
        } else {
          div.innerHTML = `<p style="color:red;">❌ Issue not found.</p>`;
        }
      </script>
    <?php endif; ?>
  </div>

  <div class="vote-section">
    <button class="vote-btn" onclick="vote(1)">👍</button>
    <span id="vote-count">0</span>
    <button class="vote-btn" onclick="vote(-1)">👎</button>
  </div>

  <div class="comment-section">
    <h3>Comments (<span id="commentCount">0</span>)</h3>
    <textarea id="commentText" placeholder="Write a comment..."></textarea>
    <button class="comment-btn" onclick="submitComment()">Post Comment</button>
    <div id="commentList" class="comment-list"></div>
  </div>
</div>

<script>
  const titleKey = decodeURIComponent(new URLSearchParams(window.location.search).get("title") || "");
  const voteKey = `votes_${titleKey}`;
  const commentKey = `comments_${titleKey}`;

  function vote(delta) {
    let count = parseInt(localStorage.getItem(voteKey)) || 0;
    count = Math.max(0, count + delta);
    localStorage.setItem(voteKey, count);
    document.getElementById("vote-count").textContent = count;
  }

  function submitComment() {
    const text = document.getElementById("commentText").value.trim();
    if (!text) return;
    const comments = JSON.parse(localStorage.getItem(commentKey) || "[]");
    comments.push(text);
    localStorage.setItem(commentKey, JSON.stringify(comments));
    document.getElementById("commentText").value = "";
    renderComments();
  }

  function renderComments() {
    const comments = JSON.parse(localStorage.getItem(commentKey) || "[]");
    const list = document.getElementById("commentList");
    list.innerHTML = comments.map((c, i) => `
      <div class="comment-item ${document.body.classList.contains('dark-mode') ? 'dark-mode' : ''}">
        ${c}
        <div class="comment-actions">
          <button onclick="editComment(${i})">✏️</button>
          <button onclick="deleteComment(${i})">🗑️</button>
        </div>
      </div>
    `).join("");
    document.getElementById("commentCount").textContent = comments.length;
  }

  function editComment(index) {
    const comments = JSON.parse(localStorage.getItem(commentKey) || "[]");
    const newText = prompt("Edit comment:", comments[index]);
    if (newText !== null) {
      comments[index] = newText;
      localStorage.setItem(commentKey, JSON.stringify(comments));
      renderComments();
    }
  }

  function deleteComment(index) {
    const comments = JSON.parse(localStorage.getItem(commentKey) || "[]");
    comments.splice(index, 1);
    localStorage.setItem(commentKey, JSON.stringify(comments));
    renderComments();
  }

  // Dark mode toggle
  document.getElementById("toggleDarkMode").onclick = () => {
    document.body.classList.toggle("dark-mode");
    document.getElementById("mainContainer").classList.toggle("dark-mode");
    localStorage.setItem("darkMode", document.body.classList.contains("dark-mode"));
    renderComments();
  };

  // Init
  document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("vote-count").textContent = localStorage.getItem(voteKey) || "0";
    if (localStorage.getItem("darkMode") === "true") {
      document.body.classList.add("dark-mode");
      document.getElementById("mainContainer").classList.add("dark-mode");
    }
    renderComments();
  });
</script>
</body>
</html>
