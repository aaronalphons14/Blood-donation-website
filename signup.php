<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = ""; 
$dbname = "blood_donation";


$conn = new mysqli($servername, $dbUsername, $dbPassword);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($createDbQuery) === TRUE) {
    $conn->select_db($dbname);
} else {
    die("Error creating database: " . $conn->error);
}


$createTableQuery = "CREATE TABLE IF NOT EXISTS existing_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    dob DATE,
    blood_group VARCHAR(5),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
)";
$conn->query($createTableQuery);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $bloodGroup = $_POST['bloodGroup'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $checkUserQuery = "SELECT * FROM existing_users WHERE username='$username'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose a different one.'); window.location.href='signup.php';</script>";
    } else {
       
        $insertQuery = "INSERT INTO existing_users 
                        (first_name, last_name, email, dob, blood_group, username, password) 
                        VALUES ('$firstName', '$lastName', '$email', '$dob', '$bloodGroup', '$username', '$hashedPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Registration successful. You can now log in.'); window.location.href='login.html';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation App - Sign Up</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Create Your Account</h2>
            <form id="signupForm" method="POST">
                <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                <input type="email" name="email" id="email" placeholder="Gmail" required>
                <input type="date" name="dob" id="dob" required>
                <select name="bloodGroup" id="bloodGroup" required>
                    <option value="" disabled selected>Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
                <p id="signupMessage"></p>
            </form>
            <div class="link-option">
                <p>Already have an account? <a href="login.html">Log In</a></p>
            </div>
        </div>
    </div>
    <script src="signup.js"></script>
</body>
</html>
