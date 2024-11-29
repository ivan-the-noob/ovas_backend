<?php
session_start();
try {
    if (isset($_POST['id'])) {
        $appointmentId = $_POST['id'];

        require '../../../../db.php';  

        if (!$conn) {
            throw new Exception("Database connection failed.");
        }

        $sql = "DELETE FROM appointments WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header("Location: ../../web/api/appointment.php"); 
            exit(); 
        } else {
            throw new Exception("Error executing delete query.");
        }
    } else {
        throw new Exception("Appointment ID not provided.");
    }
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
