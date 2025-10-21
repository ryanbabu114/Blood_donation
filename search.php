<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Find Donors | LifeLink</title>
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
        <a href="login.php">Login</a>
        <a href="search.php" class="active">Find Donors</a>
        <a href="contact.html">Contact Us</a>
      </nav>
    </header>

    <section class="form-section">
      <div class="form-container search-form-container">
        <h2>Search for Blood Donors</h2>
        <p class="form-intro">Find available donors in your city.</p>

        <div class="search-info">
          <strong>Search Tip:</strong> Please enter the full blood group (e.g., 'A+', 'O-') and city name for the most accurate results.
        </div>

        <form action="search.php" method="POST" class="form-box search-form">
          <div class="input-group">
            <label for="blood_group">Blood Group</label>
            <input type="text" id="blood_group" name="blood_group" placeholder="e.g., A+" required>
          </div>
          <div class="input-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" placeholder="Enter city" required>
          </div>
          <button type="submit" name="search" class="btn">Search</button>
        </form>

        <div class="results-container">
        <?php
        if (isset($_POST['search'])) {
            include 'db_connect.php';

            $blood = trim(strtoupper($_POST['blood_group']));
            $city = trim($_POST['city']);

            if (!preg_match("/^(A|B|AB|O)[+-]$/i", $blood)) {
                echo "<div class='alert'>Invalid blood group format. Use A+, A-, B+, B-, AB+, AB-, O+, O-</div>";
            } else {
                $stmt = $conn->prepare("SELECT name, city, phone, blood_group 
                                        FROM users 
                                        WHERE blood_group=? AND city=? AND user_type='donor'");
                $stmt->bind_param("ss", $blood, $city);
                $stmt->execute();
                $result = $stmt->get_result();

                echo "<h3>Matching Donors:</h3>";
                if ($result->num_rows > 0) {
                    echo "<table class='search-results-table'><tr><th>Name</th><th>City</th><th>Phone</th><th>Blood Group</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".htmlspecialchars($row['name'])."</td>
                                <td>".htmlspecialchars($row['city'])."</td>
                                <td>".htmlspecialchars($row['phone'])."</td>
                                <td>".htmlspecialchars($row['blood_group'])."</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No donors found matching your criteria.</p>";
                }
                $stmt->close();
                $conn->close();
            }
        }
        ?>
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