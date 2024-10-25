<?php
session_start();
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reviewId = $_POST['review_id'];

    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = :id");
    $stmt->bindParam(':id', $reviewId);
    
    if ($stmt->execute()) {
        header('Location: ../../web/api/review.php'); 
    } else {
        echo "<p class='alert alert-danger'>There was an error deleting the review. Please try again.</p>";
    }
}
?>
