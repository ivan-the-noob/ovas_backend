<?php

require '../../../../../db.php';

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    try {
        // First, get the category name to include in the notification
        $category_sql = "SELECT category_name FROM categories WHERE id = :id";
        $category_stmt = $conn->prepare($category_sql);
        $category_stmt->bindParam(':id', $category_id, PDO::PARAM_INT);
        $category_stmt->execute();
        $category = $category_stmt->fetch(PDO::FETCH_ASSOC);

        if ($category) {
            // Delete the category
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                // Insert a notification
                $message = "{$category['category_name']} category has been deleted.";
                $notification_sql = "INSERT INTO notifications (message, is_read) VALUES (:message, 0)";
                $notification_stmt = $conn->prepare($notification_sql);
                $notification_stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $notification_stmt->execute();

                // Redirect or confirm deletion
                header('Location: ../../../web/api/category-list.php');
                exit();
            } else {
                echo "Error: Unable to delete category";
            }
        } else {
            echo "Category not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid category ID.";
}
?>
