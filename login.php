<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
  <link rel="stylesheet" href="style.css" />
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
      <a href="login.php" class="active">Login</a>
      <a href="search.php">Find Donors</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <!-- Login Form -->
  <section class="form-section">
    <div class="form-container">
      <h2>Login to Your Account</h2>

      <?php if ($message != ''): ?>
        <div class="alert"><?= htmlspecialchars($message) ?></div>
      <?php endif; ?>

      <form action="login.php" method="POST" class="form-box">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>

        <button type="submit" name="login" class="btn">Login</button>

        <p class="form-footer">Don’t have an account? <a href="register.php">Register here</a>.</p>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 <strong>LifeLink</strong> | Built with ❤️ to Save Lives</p>
  </footer>
</body>
</html>
