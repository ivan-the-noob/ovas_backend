<?php
require '../../../../db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $owner_name = $_POST['owner_name'];
    $services = $_POST['services']; 
    $cost = $_POST['cost']; 
    $medications = isset($_POST['medication']) ? $_POST['medication'] : []; 
    $supplies = isset($_POST['supplies']) ? $_POST['supplies'] : []; 
    $total = $_POST['total'];
    $cash_tendered = $_POST['cash_tendered']; 
    $changee = $cash_tendered - $total; 

    try {
        $services_data = json_encode($services); 
        $cost_data = json_encode($cost); 
        $medications_data = json_encode($medications); 
        $supplies_data = json_encode($supplies); 

        $stmt = $conn->prepare("INSERT INTO pos_records (owner_name, services, cost, medication, supplies, total, cash_tendered, changee) VALUES (:owner_name, :services, :cost, :medication, :supplies, :total, :cash_tendered, :changee)");
        $stmt->bindParam(':owner_name', $owner_name);
        $stmt->bindParam(':services', $services_data); 
        $stmt->bindParam(':cost', $cost_data); 
        $stmt->bindParam(':medication', $medications_data); 
        $stmt->bindParam(':supplies', $supplies_data); 
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':cash_tendered', $cash_tendered);
        $stmt->bindParam(':changee', $changee); 

        $stmt->execute();

        header('Location: ../../web/api/transaction.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
