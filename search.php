<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Find Donors | LifeLink</title>
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
      <a href="register.php">Register</a>
      <a href="login.php">Login</a>
      <a href="search.php" class="active">Find Donors</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <section class="form-section">
    <div class="form-container" style="max-width: 800px;">
      <h2>Search for Blood Donors</h2>
      <form action="search.php" method="POST" class="form-box search-form">
        <div class="input-group">
            <label>Blood Group (e.g., A+, O-)</label>
            <input type="text" name="blood_group" placeholder="A+" required>
        </div>
        <div class="input-group">
            <label>City</label>
            <input type="text" name="city" placeholder="Enter city" required>
        </div>
        <button type="submit" name="search" class="btn">Search</button>
      </form>

      <div class="results-container">
      <?php
      if (isset($_POST['search'])) {
          include 'db_connect.php';

          // Sanitize inputs
          $blood = trim($_POST['blood_group']);
          $city = trim($_POST['city']);

          // Optional: validate blood group format
          if (!preg_match("/^(A|B|AB|O)[+-]$/i", $blood)) {
              echo "<div class='alert'>Invalid blood group format. Use A+, A-, B+, B-, AB+, AB-, O+, O-</div>";
          } else {
              // Prepare and execute statement to prevent SQL injection
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
                  echo "<p>No donors found for that search.</p>";
              }

              $stmt->close();
              $conn->close();
          }
      }
      ?>
      </div>
    </div>
  </section>

  <footer>
    <p>© 2025 <strong>LifeLink</strong> | Built with ❤️ to Save Lives</p>
  </footer>
</body>
</html>