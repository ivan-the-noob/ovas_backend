<?php
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'];

    try {
        
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            
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
