<?php
// db.php
$host = 'localhost';
$dbname = 'u373116035_ovas';
$username = 'u373116035_rachel';
$password = '#Rachel23';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
