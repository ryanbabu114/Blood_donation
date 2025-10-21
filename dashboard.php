<?php
session_start();

// If user is not logged in, redirect to login page
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
  <link rel="stylesheet" href="style.css">
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
      <a href="search.php">Find Donors</a>
      <a href="register.php">Update Profile</a>
      <a href="logout.php" class="btn-logout">Logout</a>
    </nav>
  </header>

  <!-- Dashboard Section -->
  <section class="dashboard">
    <div class="dashboard-container">
      <h2>Welcome, <?= $name; ?> 👋</h2>
      <p>You are now logged in to <strong>LifeLink Blood Donation System</strong>.</p>

      <div class="dashboard-actions">
        <a href="search.php" class="dash-card">
          <img src="images/search-donor.png" alt="search">
          <h3>Find Donors</h3>
          <p>Search for available blood donors near your location.</p>
        </a>

        <a href="register.php" class="dash-card">
          <img src="images/profile-update.png" alt="update">
          <h3>Update Profile</h3>
          <p>Keep your donor information up to date easily.</p>
        </a>

        <a href="logout.php" class="dash-card logout-card">
          <img src="images/logout-icon.png" alt="logout">
          <h3>Logout</h3>
          <p>End your session securely and return to login.</p>
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 <strong>LifeLink</strong> | Built with ❤️ to Save Lives</p>
  </footer>
</body>
</html>
