<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
$name = htmlspecialchars($_SESSION['name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | LifeLink</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="content-wrapper">
    <header class="navbar">
      <a href="index.html" class="logo">
        <img src="images/heart-icon.png" alt="logo">
        <h1>LifeLink</h1>
      </a>
      <nav>
        <a href="index.html">Home</a>
        <a href="search.php">Find Donors</a>
        <a href="register.php">Update Profile</a>
        <a href="logout.php" class="btn-logout">Logout</a>
      </nav>
    </header>

    <section class="dashboard">
      <div class="dashboard-container">
        <h2>Welcome back, <?= $name; ?>! 👋</h2>
        <p>Manage your donor profile and find help when you need it.</p>

        <div class="dashboard-actions">
          <a href="search.php" class="dash-card">
            <span class="icon-emoji">🔍</span>
            <h3>Find Donors</h3>
            <p>Search for available blood donors near your location.</p>
          </a>

          <a href="register.php" class="dash-card">
            <span class="icon-emoji">👤</span>
            <h3>Update Profile</h3>
            <p>Keep your donor information up to date easily.</p>
          </a>

          <a href="logout.php" class="dash-card logout-card">
            <span class="icon-emoji">🚪</span>
            <h3>Logout</h3>
            <p>End your session securely and return to the login page.</p>
          </a>
        </div>
      </div>
    </section>
  </div><footer class="site-footer">
    <div class="footer-grid">
      <div class="footer-about">
        <a href="index.html" class="logo">
          <img src="images/heart-icon.png" alt="logo">
          <h4>LifeLink</h4>
        </a>
        <p>A dedicated platform to connect blood donors and recipients, making it easier to save lives together.</p>
      </div>
      <div class="footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a href="search.php">Find Donors</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h4>About</h4>
        <ul>
          <li><a href="contact.html">About Us</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li><a href="#">Eligibility</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h4>Contact</h4>
        <ul>
          <li><a href="mailto:lifelink@support.com">lifelink@support.com</a></li>
          <li><a href="tel:+919876543210">+91-9876543210</a></li>
          <li><a href="#">Kerala, India</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 <strong>LifeLink</strong> | Built with ❤️ to Save Lives</p>
    </div>
  </footer>
</body>
</html>