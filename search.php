<?php
// database connection
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

if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $stmt = $pdo->prepare("SELECT * FROM donors WHERE place = ?");
    $stmt->execute([$city]);
    $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
