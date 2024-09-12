<?php
require '../../../../db.php';  // Include your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $owner_name = $_POST['owner_name'];
    $services = $_POST['services']; // Array of services
    $cost = $_POST['cost']; // Array of cost for corresponding services
    $medications = isset($_POST['medication']) ? $_POST['medication'] : []; // Array of medications
    $supplies = isset($_POST['supplies']) ? $_POST['supplies'] : []; // Array of supplies
    $total = $_POST['total'];

    try {
        // Combine services, medications, and supplies into a single JSON field
        $services_data = json_encode($services); // Convert services array to JSON
        $cost_data = json_encode($cost); // Convert cost array to JSON
        $medications_data = json_encode($medications); // Convert medications array to JSON
        $supplies_data = json_encode($supplies); // Convert supplies array to JSON

        // Insert the combined data into the database
        $stmt = $conn->prepare("INSERT INTO pos_records (owner_name, services, cost, medication, supplies, total) VALUES (:owner_name, :services, :cost, :medication, :supplies, :total)");
        $stmt->bindParam(':owner_name', $owner_name);
        $stmt->bindParam(':services', $services_data); // JSON encoded services
        $stmt->bindParam(':cost', $cost_data); // JSON encoded cost
        $stmt->bindParam(':medication', $medications_data); // JSON encoded medications
        $stmt->bindParam(':supplies', $supplies_data); // JSON encoded supplies
        $stmt->bindParam(':total', $total);

        $stmt->execute();

        header('Location: ../../web/api/transaction.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
