<?php
session_start();
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $profilePicture = isset($_FILES['profile_picture']) ? $_FILES['profile_picture'] : null;
    $email = $_SESSION['email'];

    try {
        // Fetch user data
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check for password update
            if (!empty($newPassword)) {
                if ($newPassword === $confirmPassword) {
                    if (password_verify($currentPassword, $user['password'])) {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
                        $stmt->bindParam(':password', $hashedPassword);
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();

                        // Insert password change notification
                        $stmt = $conn->prepare("INSERT INTO notifications (email, type, message) VALUES (:email, 'password', 'Your password has been updated.')");
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();

                        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Password updated successfully!'];
                    } else {
                        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Current password is incorrect.'];
                    }
                } else {
                    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'New passwords do not match.'];
                }
            }

            // Check for profile picture update
            if (isset($profilePicture) && !empty($profilePicture['name'])) {
                if ($profilePicture['error'] == 0) {
                    $targetDir = "../../../../assets/img/profile/";
                    $fileName = basename($profilePicture['name']);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
                    if (in_array($fileType, $allowedTypes)) {
                        if (move_uploaded_file($profilePicture['tmp_name'], $targetFilePath)) {
                            $stmt = $conn->prepare("UPDATE users SET profile_picture = :profile_picture WHERE email = :email");
                            $stmt->bindParam(':profile_picture', $fileName);
                            $stmt->bindParam(':email', $email);
                            $stmt->execute();
                            $_SESSION['profile_picture'] = $fileName;

                            // Insert profile picture change notification
                            $stmt = $conn->prepare("INSERT INTO notifications (email, type, message) VALUES (:email, 'profile', 'Your profile picture has been updated.')");
                            $stmt->bindParam(':email', $email);
                            $stmt->execute();

                            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Profile picture updated successfully!'];
                        } else {
                            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Error uploading the file.'];
                        }
                    } else {
                        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Only JPG, JPEG, PNG & GIF files are allowed.'];
                    }
                } else {
                    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Error with the file upload. Please try again.'];
                }
            } else {
                if (empty($newPassword)) {
                    $_SESSION['alert'] = ['type' => 'info', 'message' => 'No changes made to the profile picture.'];
                }
            }
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'User not found.'];
        }
    } catch (PDOException $e) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'An error occurred: ' . $e->getMessage()];
    }

    // Redirect back with the alert
    header('Location: ../../web/api/settings.php');
    exit();
}
?>
