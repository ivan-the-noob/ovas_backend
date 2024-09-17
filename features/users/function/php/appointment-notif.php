<?php
require '../../../../db.php'; 

session_start();
$user_email = $_SESSION['email'] ?? '';

// Mark all notifications as read for the user
$stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE email = :email AND is_read = 0");
$stmt->bindParam(':email', $user_email);
$stmt->execute();
?>
