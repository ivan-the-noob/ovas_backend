<?php
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id']; 
    $unavailableDate = htmlspecialchars(trim($_POST['unavailable_date'])); 
    $reason = htmlspecialchars(trim($_POST['reason'])); 

    if (!empty($unavailableDate) && !empty($reason) && $id > 0) {
        try {
            $stmt = $conn->prepare("UPDATE unavailable SET unavailable = :unavailable, reason = :reason WHERE id = :id");
            
            $stmt->bindParam(':unavailable', $unavailableDate);
            $stmt->bindParam(':reason', $reason); 
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 

            if ($stmt->execute()) {
                header("Location: ../../web/api/unavailable.php?message=Unavailable status updated successfully");
                exit();
            } else {
                echo "Failed to update unavailable status.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    } else {
        echo "Please fill in all the fields and ensure the ID is valid.";
    }
}
?>
