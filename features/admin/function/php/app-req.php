<?php 

try {
    $stmt = $conn->prepare("SELECT * FROM appointments");
    $stmt->execute();

    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

return $appointments; 



?>
