<?php
$conn = mysqli_connect("localhost", "root", "", "blood_donation_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Database connected successfully!";
?>
