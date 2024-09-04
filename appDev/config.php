<?php
$host = '127.0.0.1';
$db   = 'products';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3307;dbname=$db", $user, $pass); // Example if port is 3307

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db: " . $e->getMessage());
}
?>
