# 🩸 Online Blood Donation Management System

A web-based platform designed to connect blood donors and recipients efficiently.  
Built using **HTML**, **PHP**, and **MySQL**, this system simplifies the process of donor registration, login, and searching for donors by blood group and location.

---

## 🚀 Features

- 🧍‍♂️ **User Registration:** Donors and recipients can register with details such as name, city, blood group, and contact info.  
- 🔐 **Login System:** Secure login for users to access or update their details.  
- 🔍 **Search Donors:** Find available donors by blood group and city.  
- 📋 **Database Management:** All donor/recipient records are stored in a MySQL database.  
- 📞 **Contact Page:** Users can view contact details for assistance.  

---

## 🏗️ Tech Stack

| Category | Technology |
|-----------|-------------|
| Frontend | HTML, CSS |
| Backend | PHP |
| Database | MySQL |
| Server | XAMPP / Apache |

---

## 📁 Folder Structure

Blood_donation/
│
├── assets/
│ └── css/
│ └── style.css
│
├── db_connect.php
├── index.html
├── register.php
├── login.php
├── search.php
├── contact.html
└── README.md

---


---

## ⚙️ Installation & Setup

### Step 1: Install XAMPP
Download and install [XAMPP](https://www.apachefriends.org/index.html) for your OS.

### Step 2: Place Project Files
1. Download or clone the project repository:
   ```bash
   git clone https://github.com/<your-team-repo>/Blood_donation.git
Move the project folder into your XAMPP directory:
C:\xampp\htdocs\Blood_donation\

Open VS Code and open the folder:
File → Open Folder → Blood_donation

### Step 3: Start Apache & MySQL
Open the XAMPP Control Panel → Start both **Apache** and **MySQL**.

### Step 4: Create Database
1. Go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin)  
2. Click **New** → Create a database named `blood_donation`.  
3. Run the following SQL to create the `users` table:
   ```sql
   CREATE TABLE users (
       id INT(11) AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100),
       email VARCHAR(100),
       password VARCHAR(100),
       blood_group VARCHAR(10),
       city VARCHAR(100),
       phone VARCHAR(15),
       user_type VARCHAR(20)
   );

### Step 5: Configure Database Connection

Edit db_connect.php:

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

### Step 6: Run the Project

Go to your browser and open:

http://localhost/Blood_donation/index.html
