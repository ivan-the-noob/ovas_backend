<?php
session_start();
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointmentId = $_POST['id'];
    $reasonCancel = $_POST['reason_cancel'];
    $userEmail = $_SESSION['email'];

    try {
        if (empty($reasonCancel)) {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Cancellation reason is required.'];
            header('Location: ../../web/api/appointments.php');
            exit();
        }

        $stmt = $conn->prepare("UPDATE appointments SET status = 'cancelled', reason_cancel = :reason_cancel WHERE id = :appointmentId");
        $stmt->bindParam(':reason_cancel', $reasonCancel);
        $stmt->bindParam(':appointmentId', $appointmentId);
        $stmt->execute();

        $notificationMessage = "Your appointment has been cancelled.";
        $notificationType = "cancel";

        $notificationStmt = $conn->prepare("INSERT INTO notifications (email, type, message) VALUES (:email, :type, :message)");
        $notificationStmt->bindParam(':email', $userEmail);
        $notificationStmt->bindParam(':type', $notificationType);
        $notificationStmt->bindParam(':message', $notificationMessage);
        $notificationStmt->execute();

        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Appointment cancelled successfully.'];
    } catch (PDOException $e) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'An error occurred: ' . $e->getMessage()];
    }

    header('Location: ../../web/api/appointments.php');
    exit();
}
?>
