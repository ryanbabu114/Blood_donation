<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logging Out | LifeLink</title>
  <link rel="stylesheet" href="style.css" />
  <meta http-equiv="refresh" content="2;url=login.php">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="images/heart-icon.png" alt="logo">
      <h1>LifeLink</h1>
    </div>
    <nav>
      <a href="index.html">Home</a>
      <a href="register.php">Register</a>
      <a href="login.php">Login</a>
      <a href="search.php">Find Donors</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <!-- Logout Message -->
  <section class="form-section">
    <div class="form-container">
      <h2>You have been logged out.</h2>
      <p>Redirecting to login page...</p>
      <div class="spinner"></div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 <strong>LifeLink</strong> | Built with ❤️ to Save Lives</p>
  </footer>
</body>
</html>
