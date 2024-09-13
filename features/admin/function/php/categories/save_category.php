<?php
// Include the database connection file
require '../../../../../db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the category name from the form safely using trim and filter
    $category_name = trim($_POST['category_name']);
    
    if (!empty($category_name)) {
        try {
            // Prepare an SQL statement to prevent SQL injection
            $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";
            $stmt = $conn->prepare($sql);
            
            // Bind the parameter to prevent SQL injection
            $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
            
            // Execute the statement
            if ($stmt->execute()) {
                header('Location: ../../../web/api/category-list.php');
            } else {
                echo "Error: Unable to add category";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Category name cannot be empty.";
    }

    // Close the connection (optional as PDO closes automatically)
    $conn = null;
}
?>
