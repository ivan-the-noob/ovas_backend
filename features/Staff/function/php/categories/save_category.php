<?php

require '../../../../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $category_name = trim($_POST['category_name']);
    
    if (!empty($category_name)) {
        try {
            // Insert the new category
            $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                // Prepare the notification message
                $message = "New category $category_name has been added.";
                
                // Insert the notification into the notifications table
                $notification_sql = "INSERT INTO notifications (message, is_read) VALUES (:message, 0)";
                $notification_stmt = $conn->prepare($notification_sql);
                $notification_stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $notification_stmt->execute();
                
                // Redirect to the category list
                header('Location: ../../../web/api/category-list.php');
                exit();
            } else {
                echo "Error: Unable to add category";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Category name cannot be empty.";
    }

    $conn = null;
}
?>
