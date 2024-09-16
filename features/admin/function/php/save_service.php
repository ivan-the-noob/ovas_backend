<?php

require '../../../../db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $service_type = $_POST['service_type'];
    $service_name = $_POST['service_name'];
    $cost = $_POST['cost'];
    $discount = $_POST['discount'];
    $info = $_POST['info'];  

    
    if (!empty($service_type) && !empty($service_name) && is_numeric($cost)) {
        try {
            
            $sql = "INSERT INTO service_list (service_type, service_name, cost, discount, info) 
                    VALUES (:service_type, :service_name, :cost, :discount, :info)";
            $stmt = $conn->prepare($sql);
            
            
            $stmt->bindParam(':service_type', $service_type);
            $stmt->bindParam(':service_name', $service_name);
            $stmt->bindParam(':cost', $cost);
            $stmt->bindParam(':discount', $discount);
            $stmt->bindParam(':info', $info);  
            
            
            $stmt->execute();
            
            header('Location: ../../web/api/service-list.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill all required fields.";
    }
}


$conn = null;
?>
