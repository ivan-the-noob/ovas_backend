<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = NULL;

    if (isset($_FILES['faq_image']) && $_FILES['faq_image']['error'] == 0) {
        $targetDir = "../../../../assets/img/faqs"; 
        $fileExtension = pathinfo($_FILES["faq_image"]["name"], PATHINFO_EXTENSION); 
        $uniqueName = uniqid('faq_', true) . '.' . $fileExtension; 
        $targetFile = $targetDir . '/' . $uniqueName; 

        if (move_uploaded_file($_FILES["faq_image"]["tmp_name"], $targetFile)) {
            $image = $uniqueName; 
        }
    }

    if ($image !== NULL) {
        try {
            $stmt = $conn->prepare("INSERT INTO faqs (image) VALUES (:image)");

            $stmt->bindParam(':image', $image, PDO::PARAM_STR);

            if ($stmt->execute()) {
                header('Location: ../../web/api/faqs.php');
            } else {
                echo "Error: Unable to insert data.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No image uploaded.";
    }
}
?>
