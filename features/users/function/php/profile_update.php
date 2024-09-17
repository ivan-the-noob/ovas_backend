<?php
session_start();
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $profilePicture = $_FILES['profile_picture'];

    // Get current session user info
    $email = $_SESSION['email'];

    // Fetch user data from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Handle password update if new password is provided
        if (!empty($newPassword)) {
            // Check current password
            if (password_verify($currentPassword, $user['password'])) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                echo "<p class='alert alert-success'>Password updated successfully!</p>";
            } else {
                echo "<p class='alert alert-danger'>Current password is incorrect.</p>";
                exit(); // Stop execution if password is incorrect
            }
        }

        // Handle profile picture upload
        if ($profilePicture && $profilePicture['error'] == 0) {
            $targetDir = "../../../../assets/img/profile/";
            $fileName = basename($profilePicture['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow only certain file formats
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Upload file
                if (move_uploaded_file($profilePicture['tmp_name'], $targetFilePath)) {
                    // Update profile picture in the database
                    $stmt = $conn->prepare("UPDATE users SET profile_picture = :profile_picture WHERE email = :email");
                    $stmt->bindParam(':profile_picture', $fileName);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();
                    $_SESSION['profile_picture'] = $fileName;
                    echo "<p class='alert alert-success'>Profile picture updated successfully!</p>";
                } else {
                    echo "<p class='alert alert-danger'>There was an error uploading the file.</p>";
                }
            } else {
                echo "<p class='alert alert-danger'>Only JPG, JPEG, PNG & GIF files are allowed.</p>";
            }
        } elseif ($profilePicture && $profilePicture['error'] !== 0) {
            echo "<p class='alert alert-danger'>Error with the file upload. Please try again.</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>User not found.</p>";
    }
}
?>
