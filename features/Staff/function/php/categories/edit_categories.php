<?php

require '../../../../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $category_id = $_POST['id'];
    $new_category_name = trim($_POST['category_name']);

    if (!empty($new_category_name)) {
        try {
            // Update the category name
            $sql = "UPDATE categories SET category_name = :category_name WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category_name', $new_category_name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Prepare the notification message
                $message = "$new_category_name category has been edited.";
                
                // Insert the notification into the correct table
                $notification_sql = "INSERT INTO notifications (message, is_read) VALUES (:message, 0)";
                $notification_stmt = $conn->prepare($notification_sql);
                $notification_stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $notification_stmt->execute();

                header('Location: ../../../web/api/category-list.php');
                exit();
            } else {
                echo "Error: Unable to update category";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Category name cannot be empty.";
    }
} else {
    echo "Invalid request.";
}
?>
