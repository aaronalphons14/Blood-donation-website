<?php
// Database connection
$host = 'localhost';
$dbname = 'blood_donation';
$username = 'root'; // your username
$password = ''; // your password
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $place = $_POST['place'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $bloodGroup = $_POST['blood-group'];

    // SQL query to insert data into the donors table
    $sql = "INSERT INTO donors (name, place, phone, email, dob, blood_group) 
            VALUES (:name, :place, :phone, :email, :dob, :bloodGroup)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':bloodGroup', $bloodGroup);
        
        // Execute the query
        $stmt->execute();
        
        echo "User successfully registered!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
