<?php
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['id'] ?? '';
    $decline_reason = $_POST['declineReason'] ?? ''; 

    if (!empty($appointment_id) && !empty($decline_reason)) {
        try {
            $stmt = $conn->prepare("UPDATE appointments SET status = 'decline', decline_reason = :decline_reason WHERE id = :id");
            $stmt->bindParam(':decline_reason', $decline_reason);
            $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: ../../web/api/app-req.php');  
            exit();
        } catch (PDOException $e) {
            echo 'failure'; 
        }
    } else {
        echo 'failure'; 
    }
    $conn = null;
}
?>
