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
<meta charset="UTF-8">
<title>Register - Blood Donation</title>
</head>
<body>
<h2>User Registration</h2>

<?php if($message != '') { echo "<p>$message</p>"; } ?>

<form action="register.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Blood Group:</label><br>
    <input type="text" name="blood_group" required><br><br>

    <label>City:</label><br>
    <input type="text" name="city" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" required><br><br>

    <label>User Type:</label><br>
    <select name="user_type" required>
        <option value="donor">Donor</option>
        <option value="recipient">Recipient</option>
    </select><br><br>

    <input type="submit" name="submit" value="Register">
</form>
</body>
</html>
