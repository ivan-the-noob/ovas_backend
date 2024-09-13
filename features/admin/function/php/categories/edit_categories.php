<?php
// Include the database connection
require '../../../../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the category ID and new category name from the form
    $category_id = $_POST['id'];
    $new_category_name = trim($_POST['category_name']);

    if (!empty($new_category_name)) {
        try {
            // Prepare the UPDATE statement
            $sql = "UPDATE categories SET category_name = :category_name WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category_name', $new_category_name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);

            // Execute the query
            if ($stmt->execute()) {
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
