<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = ""; 
$dbname = "blood_donation";


$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $checkUserQuery = "SELECT * FROM existing_users WHERE username='$username'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];

        
        if (password_verify($password, $hashedPassword)) {
            header("Location: dashboard.php");
            exit();
        } else {
            
            $errorMessage = "Incorrect password. Please try again.";
        }
    } else {
        $errorMessage = "User does not exist. Please check your username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation App - Login</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Welcome Back!</h2>
            <p>Log in to continue saving lives.</p>
            <form method="POST" id="loginForm">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                
                <?php if (isset($errorMessage)): ?>
                    <p id="errorMessage" style="color: red;"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
            </form>
            <div class="link-option">
                <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
