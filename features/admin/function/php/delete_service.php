<?php
require '../../../../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        
        $sql = "DELETE FROM service_list WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            
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


$conn = null;
?>
