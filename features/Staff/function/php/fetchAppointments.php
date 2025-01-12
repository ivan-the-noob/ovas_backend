<?php
require '../../../../db.php'; 

try {
    $sql = "SELECT GROUP_CONCAT(appointment_date) AS dates FROM appointments WHERE status = 'confirm'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $result['dates']; // Return dates as CSV string
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
