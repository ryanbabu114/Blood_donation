<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php';

$message = '';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    // Check if email already exists
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
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
  <header class="navbar">
    <div class="logo">
      <img src="images/heart-icon.png" alt="logo">
      <h1>LifeLink</h1>
    </div>
    <nav>
      <a href="index.html">Home</a>
      <a href="register.php" class="active">Register</a>
      <a href="login.php">Login</a>
      <a href="search.php">Find Donors</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <section class="form-section">
    <div class="form-container">
      <h2>Create Your Account</h2>

      <?php if ($message != ''): ?>
        <div class="alert"><?= $message ?></div>
      <?php endif; ?>

      <form action="register.php" method="POST" class="form-box">
        <label>Name</label>
        <input type="text" name="name" placeholder="Enter your full name" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Create a password" required>

        <label>Blood Group (e.g., A+, O-)</label>
        <input type="text" name="blood_group" placeholder="Enter blood group" required>

        <label>City</label>
        <input type="text" name="city" placeholder="Enter your city" required>

        <label>Phone</label>
        <input type="text" name="phone" placeholder="Enter your phone number" required>

        <label>I am a...</label>
        <select name="user_type" required>
            <option value="donor">Donor</option>
            <option value="recipient">Recipient</option>
        </select>

        <button type="submit" name="submit" class="btn">Register</button>

        <p class="form-footer">Already have an account? <a href="login.php">Login here</a>.</p>
      </form>
    </div>
  </section>

  <footer>
    <p>© 2025 <strong>LifeLink</strong> | Built with ❤️ to Save Lives</p>
  </footer>
</body>
</html>