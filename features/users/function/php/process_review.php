<?php
session_start();
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];  
    $image = null; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']); 

        $uniqueImageName = time() . '_' . $imageName; 

        $uploadDir = '../../../../assets/img/review/';
        $imagePath = $uploadDir . $uniqueImageName;  

        if (move_uploaded_file($imageTmp, $imagePath)) {
            $image = $uniqueImageName;  
        } else {
            echo "<p class='alert alert-danger'>There was an error uploading your image.</p>";
        }
    }

    $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Anonymous';
    $profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;

    $stmt = $conn->prepare("INSERT INTO reviews (name, profile_picture, comment, rating, image, view) VALUES (:name, :profile_picture, :comment, :rating, :image, 0)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':profile_picture', $profilePicture);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':rating', $rating); 
    $stmt->bindParam(':image', $image);  
    if ($stmt->execute()) {
        header('Location: ../../../../index.php');
    } else {
        echo "<p class='alert alert-danger'>There was an error submitting your review. Please try again.</p>";
    }
}
?>
