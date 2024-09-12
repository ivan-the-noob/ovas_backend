<?php
require '../../../../db.php'; 

try {

    $stmt = $conn->prepare("SELECT service_name, cost FROM service_list");
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
