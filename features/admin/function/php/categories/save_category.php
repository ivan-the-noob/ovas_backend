<?php

require '../../../../../db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $category_name = trim($_POST['category_name']);
    
    if (!empty($category_name)) {
        try {
            
            $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";
            $stmt = $conn->prepare($sql);
            
            
            $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
            
            
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

    
    $conn = null;
}
?>
