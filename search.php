<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Donors</title>
  <style>
    table { border-collapse: collapse; width: 80%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
  </style>
</head>
<body>
  <h2>Search for Blood Donors</h2>
  <form action="search.php" method="POST">
    <label>Blood Group (e.g., A+, O-):</label>
    <input type="text" name="blood_group" required>
    <label>City:</label>
    <input type="text" name="city" required>
    <input type="submit" name="search" value="Search">
  </form>

<?php
if (isset($_POST['search'])) {
    include 'db_connect.php';

    // Sanitize inputs
    $blood = trim($_POST['blood_group']);
    $city = trim($_POST['city']);

    // Optional: validate blood group format
    if (!preg_match("/^(A|B|AB|O)[+-]$/i", $blood)) {
        echo "<p>Invalid blood group format. Use A+, A-, B+, B-, AB+, AB-, O+, O-</p>";
        exit;
    }

    // Prepare and execute statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT name, city, phone, blood_group 
                            FROM users 
                            WHERE blood_group=? AND city=? AND user_type='donor'");
    $stmt->bind_param("ss", $blood, $city);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h3>Matching Donors:</h3>";
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Name</th><th>City</th><th>Phone</th><th>Blood Group</th></tr>";
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
?>
</body>
</html>
