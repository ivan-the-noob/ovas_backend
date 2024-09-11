<?php
// Database connection
require '../../../../db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize the form inputs using PDO's prepared statements
    $service_type = $_POST['service_type'];
    $service_name = $_POST['service_name'];
    $cost = $_POST['cost'];
    $discount = $_POST['discount'];
    $info = $_POST['info'];  // Capture the new info field

    // Validate inputs
    if (!empty($service_type) && !empty($service_name) && is_numeric($cost)) {
        try {
            // Prepare an SQL statement with placeholders to prevent SQL injection
            $sql = "INSERT INTO service_list (service_type, service_name, cost, discount, info) 
                    VALUES (:service_type, :service_name, :cost, :discount, :info)";
            $stmt = $conn->prepare($sql);
            
            // Bind the form values to the SQL statement
            $stmt->bindParam(':service_type', $service_type);
            $stmt->bindParam(':service_name', $service_name);
            $stmt->bindParam(':cost', $cost);
            $stmt->bindParam(':discount', $discount);
            $stmt->bindParam(':info', $info);  // Bind the new info field
            
            // Execute the statement
            $stmt->execute();
            
            header('Location: ../../web/api/service-list.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill all required fields.";
    }
}

// Close the connection (optional since PDO does it automatically at the end of the script)
$conn = null;
?>
