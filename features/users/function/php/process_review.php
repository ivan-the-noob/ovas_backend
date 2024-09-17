<?php
session_start();
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];

    $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Anonymous';
    $profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;

    $stmt = $conn->prepare("INSERT INTO reviews (name, profile_picture, comment) VALUES (:name, :profile_picture, :comment)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':profile_picture', $profilePicture);
    $stmt->bindParam(':comment', $comment);
    
    if ($stmt->execute()) {
        header('Location: ../../../../index.php');
    } else {
        echo "<p class='alert alert-danger'>There was an error submitting your review. Please try again.</p>";
    }
}
?>
