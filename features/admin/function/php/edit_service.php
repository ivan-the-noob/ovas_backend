<?php
require '../../../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];

    
    $service_type = $_POST['service_type'];
    $service_name = $_POST['service_name'];
    $cost = $_POST['cost'];
    $discount = $_POST['discount'];
    $info = $_POST['info'];

    
    if (!empty($service_type) && !empty($service_name) && is_numeric($cost)) {
        try {
            
            $sql = "UPDATE service_list 
                    SET service_type = :service_type, service_name = :service_name, cost = :cost, discount = :discount, info = :info 
                    WHERE id = :id";

            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':service_type', $service_type);
            $stmt->bindParam(':service_name', $service_name);
            $stmt->bindParam(':cost', $cost);
            $stmt->bindParam(':discount', $discount);
            $stmt->bindParam(':info', $info);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                
                header("Location: ../../web/api/service-list.php?status=success");
                exit();
            } else {
                echo "Error updating the record.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
    }
}


$conn = null;
?>