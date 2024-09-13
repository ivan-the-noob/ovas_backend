<?php
require '../../../../db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID from the form
    $id = $_POST['id'];

    try {
        // Delete the user from the database
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Redirect back to the user list page after successful deletion
            header('Location: ../../web/api/admin-user.php');
            exit();
        } else {
            echo "Error: Could not delete user.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
