<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';
$message = '';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $blood_group = mysqli_real_escape_string($conn, strtoupper(trim($_POST['blood_group']))); // Standardize
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $message = "Email is already registered!";
    } else {
        $sql = "INSERT INTO users (name, email, password, blood_group, city, phone, user_type)
                VALUES ('$name', '$email', '$password', '$blood_group', '$city', '$phone', '$user_type')";
        if (mysqli_query($conn, $sql)) {
            $message = "Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | LifeLink</title>
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
        <a href="register.php" class="active">Register</a>
        <a href="login.php">Login</a>
        <a href="search.php">Find Donors</a>
        <a href="contact.html">Contact Us</a>
      </nav>
    </header>

    <section class="form-section">
      <div class="form-container">
        <h2>Create Your Account</h2>
        <p class="form-intro">Join our community to save lives or find help.</p>

        <?php if ($message != ''): ?>
          <div class="alert"><?= $message ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST" class="form-box">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your full name" required>

          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="e.g., you@example.com" required>

          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a secure password" required>

          <label for="blood_group">Blood Group</label>
          <input type="text" id="blood_group" name="blood_group" placeholder="e.g., O+ or B-" required>

          <label for="city">City</label>
          <input type="text" id="city" name="city" placeholder="Enter your city" required>

          <label for="phone">Phone Number</label>
          <input type="text" id="phone" name="phone" placeholder="Your contact number" required>

          <label for="user_type">I am a...</label>
          <select id="user_type" name="user_type" required>
            <option value="" disabled selected>-- Select your role --</option>
            <option value="donor">Donor (I want to donate)</option>
            <option value="recipient">Recipient (I need blood)</option>
          </select>

          <button type="submit" name="submit" class="btn">Register</button>

          <p class="form-footer">Already have an account? <a href="login.php">Login here</a>.</p>
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