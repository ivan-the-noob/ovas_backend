<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointment_id'];
    $newDate = $_POST['new_date'];

    try {
        $sql = "UPDATE appointments SET appointment_date = :new_date, status = 'resched' WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':new_date', $newDate, PDO::PARAM_STR);
        $stmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);
        $stmt->execute();

        echo 'success';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
