document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm_password').value;
    if (password !== confirm) {
        alert('Passwords do not match.');
        e.preventDefault();
    }
});
// Responsive navbar toggle
const toggle = document.getElementById('navbar-toggle');
const navLinks = document.querySelector('.nav-links');

toggle.addEventListener('click', () => {
  navLinks.classList.toggle('open');
});
// Optional: Add click handlers for demo navigation
document.querySelectorAll('.btn-primary, .btn-outline').forEach(btn => {
  btn.addEventListener('click', e => {
    // For demo purposes
    alert('This is a demo. Navigation functionality can be implemented here.');
  });
});
setCookie('isSignedIn', 'true', 7);
setCookie('userName', document.getElementById('username').value, 7);
setCookie('userAvatar', 'https://randomuser.me/api/portraits/women/44.jpg', 7);
// Redirect to report.html or wherever the ?redirect= param says
const params = new URLSearchParams(window.location.search);
const redirect = params.get('redirect') || 'index.html';
window.location.href = redirect;
