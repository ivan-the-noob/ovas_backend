<?php
session_start();

if (isset($_SESSION['email'])) {
    // Database connection
    require '../../../../db.php';

    // Get the email from session
    $email = $_SESSION['email'];

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];

        // Generate a unique image name
        $uniqueImageName = uniqid('profile_', true) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);
        $targetPath = '../../../../assets/img/profile/' . $uniqueImageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($imageTmpName, $targetPath)) {
            // Update the profile picture in the database
            try {
                $stmt = $conn->prepare("UPDATE users SET profile_picture = :profile_picture WHERE email = :email");
                $stmt->execute([
                    'profile_picture' => $uniqueImageName,
                    'email' => $email
                ]);
            
                if ($stmt->rowCount() > 0) {
                    echo json_encode(['success' => true, 'newImageName' => $uniqueImageName]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No rows updated']);
                }
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No image file uploaded']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
}
?>
