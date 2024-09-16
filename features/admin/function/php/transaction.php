<?php

try {
    $stmt = $conn->prepare("SELECT * FROM pos_records");
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>