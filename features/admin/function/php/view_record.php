<?php
require '../../../../db.php';  

try {
    $stmt = $conn->prepare("SELECT * FROM patients_records");
    $stmt->execute();
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
