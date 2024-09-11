<?php
require '../../../../db.php';
// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Prepare the SQL statement to delete the service
        $sql = "DELETE FROM service_list WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // If successful, redirect back to the service list page
            header("Location: ../../web/api/service-list.php?status=deleted");
            exit();
        } else {
            echo "Error deleting the record.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
}

// Close the database connection (optional as PDO does this automatically)
$conn = null;
?>
