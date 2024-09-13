<?php
// Include the database connection
require '../../../../../db.php';

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    try {
        // Prepare the DELETE statement
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            header('Location: ../../../web/api/category-list.php');
            exit();
        } else {
            echo "Error: Unable to delete category";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid category ID.";
}
?>
