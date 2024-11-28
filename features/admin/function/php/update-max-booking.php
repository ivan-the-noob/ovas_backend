<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sanitize input
        $id = intval($_POST['id']);
        $max_booking = intval($_POST['max_booking']);

        // Update query
        $stmt = $pdo->prepare("UPDATE max_booking SET max_booking = :max_booking WHERE id = :id");
        $stmt->execute(['max_booking' => $max_booking, 'id' => $id]);

        // Redirect back
        header("Location: ../../web/api/max-book.php");
        exit;
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit;
    }
}
