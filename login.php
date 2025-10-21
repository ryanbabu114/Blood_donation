<?php
session_start();
error_reporting(E_ALL);
include 'db_connect.php';
$message = '';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "❌ Incorrect password!";
        }
    } else {
        $message = "⚠️ Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | LifeLink</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
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
        <a href="register.php">Register</a>
        <a href="login.php" class="active">Login</a>
        <a href="search.php">Find Donors</a>
        <a href="contact.html">Contact Us</a>
      </nav>
    </header>

    <section class="form-section">
      <div class="form-container">
        <h2>Welcome Back!</h2>
        <p class="form-intro">Login to your LifeLink account.</p>

        <?php if ($message != ''): ?>
          <div class="alert"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="form-box">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>

          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>

          <button type="submit" name="login" class="btn">Login</button>

          <p class="form-footer">Don’t have an account? <a href="register.php">Register here</a>.</p>
        </form>
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