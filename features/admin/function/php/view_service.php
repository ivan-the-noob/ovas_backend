<?php

try {
    // Prepare a query to get all records and columns from the service_list table
    $sql = "SELECT * FROM service_list";  // Select all columns
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch all rows as associative arrays
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch the data and store it in the $services variable
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
