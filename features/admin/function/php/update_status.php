<?php
require '../../../../db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['id'] ?? '';
    $new_status = $_POST['status'] ?? '';

    if (!empty($appointment_id) && !empty($new_status)) {
        try {
            // Retrieve the appointment email and code if necessary
            $stmt = $conn->prepare("SELECT code, email FROM appointments WHERE id = :id");
            $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
            $stmt->execute();
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $appointment['email'] ?? '';
            $code = $appointment['code'] ?? '';

            // If the new status is 'confirm', generate a unique code
            if ($new_status === 'confirm') {
                // Get the last generated code
                $stmt = $conn->prepare("SELECT code FROM appointments WHERE code IS NOT NULL AND code LIKE 'OVAS-%' ORDER BY CAST(SUBSTRING(code, 6) AS UNSIGNED) DESC LIMIT 1");
                $stmt->execute();
                $lastAppointment = $stmt->fetch(PDO::FETCH_ASSOC);

                // Check if there is a previous code, otherwise start with OVAS-000001
                if ($lastAppointment && !empty($lastAppointment['code'])) {
                    $lastNumber = intval(substr($lastAppointment['code'], 5)); // Extract the last number part
                    $newNumber = $lastNumber + 1;
                    $newCode = 'OVAS-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT); // Increment and format the code
                } else {
                    $newCode = 'OVAS-000001';
                }

                // Update the appointment with the new code and status
                $stmt = $conn->prepare("UPDATE appointments SET status = :status, code = :code WHERE id = :id");
                $stmt->bindParam(':status', $new_status);
                $stmt->bindParam(':code', $newCode);
                $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);

            } else {
                // Update only the status if it's not 'confirm'
                $stmt = $conn->prepare("UPDATE appointments SET status = :status WHERE id = :id");
                $stmt->bindParam(':status', $new_status);
                $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
            }

            if ($stmt->execute()) {
                // Insert notification into the notifications table
                if ($new_status === 'confirm') {
                    $message = 'Your appointment has been confirmed!';
                    $stmt = $conn->prepare("INSERT INTO notifications (email, type, message, code) VALUES (:email, :type, :message, :code)");
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':type', $new_status); // Type will be 'confirm'
                    $stmt->bindParam(':message', $message);
                    $stmt->bindParam(':code', $newCode);
                    $stmt->execute();
                } elseif ($new_status === 'decline') {
                    $message = 'Your appointment has been rejected.';
                    $stmt = $conn->prepare("INSERT INTO notifications (email, type, message, code) VALUES (:email, :type, :message, :code)");
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':type', $new_status); // Type will be 'decline'
                    $stmt->bindParam(':message', $message);
                    $stmt->bindParam(':code', $code); // Use existing code
                    $stmt->execute();
                }

                echo json_encode(['success' => true, 'code' => $newCode ?? null]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update status']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
    $conn = null; // Close connection
}
