<?php
require '../../../../db.php'; 

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 

    if ($id > 0) {
        try {
            $stmt = $conn->prepare("DELETE FROM unavailable WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: ../../web/api/unavailable.php?message=Unavailable status deleted successfully");
                exit();
            } else {
                echo "Failed to delete unavailable status.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid ID.";
    }
} else {
    echo "No ID specified.";
}
?>
