<?php

try {
    
    $sql = "SELECT * FROM service_list";  
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);  
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;
?>
