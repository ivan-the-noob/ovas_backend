<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $email = $_SESSION['email']; 
    $imageId = intval($_POST['image_id']); 

    $uploadDir = '../../../../assets/img/profile/';
    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $uniqueFileName = uniqid('img_', true) . '.' . $fileExtension;
    $targetFile = $uploadDir . $uniqueFileName;
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExtension, $allowedTypes)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            try {
                if ($imageId) {
                    $stmt = $conn->prepare("
                        UPDATE album
                        SET image_path = :image_path 
                        WHERE email = :email AND id = :image_id
                    ");
                    $stmt->execute([
                        'email' => $email,
                        'image_path' => $targetFile,
                        'image_id' => $imageId 
                    ]);
                } else {
                    $stmt = $conn->prepare("
                        INSERT INTO album (email, image_path) 
                        VALUES (:email, :image_path)
                    ");
                    $stmt->execute([
                        'email' => $email,
                        'image_path' => $targetFile,
                    ]);
                }

                header("Location: ../../web/api/profile.php?success=1");
                exit();

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type.";
    }
} else {
    echo "No file uploaded.";
}
?>
