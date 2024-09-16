<?php
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['id'] ?? '';
    $new_status = $_POST['status'] ?? '';

    if (!empty($appointment_id) && !empty($new_status)) {
        try {
            // Get current appointment details
            $stmt = $conn->prepare("SELECT code, email, owner_name FROM appointments WHERE id = :id");
            $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
            $stmt->execute();
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $appointment['email'] ?? '';
            $code = $appointment['code'] ?? '';
            $owner_name = $appointment['owner_name'] ?? '';

            // Determine new code and update appointment status
            if ($new_status === 'confirm') {
                // Generate new code
                $stmt = $conn->prepare("SELECT code FROM appointments WHERE code IS NOT NULL AND code LIKE 'OVAS-%' ORDER BY CAST(SUBSTRING(code, 6) AS UNSIGNED) DESC LIMIT 1");
                $stmt->execute();
                $lastAppointment = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($lastAppointment && !empty($lastAppointment['code'])) {
                    $lastNumber = intval(substr($lastAppointment['code'], 5)); 
                    $newNumber = $lastNumber + 1;
                    $newCode = 'OVAS-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT); 
                } else {
                    $newCode = 'OVAS-000001';
                }

                // Update appointment status and code
                $stmt = $conn->prepare("UPDATE appointments SET status = :status, code = :code WHERE id = :id");
                $stmt->bindParam(':status', $new_status);
                $stmt->bindParam(':code', $newCode);
                $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);

                // Insert into admin_confirm table
                $stmt_confirm = $conn->prepare("INSERT INTO admin_confirm (email, status, name) VALUES (:email, :status, :name)");
                $stmt_confirm->bindParam(':email', $email);
                $stmt_confirm->bindParam(':status', $new_status);
                $stmt_confirm->bindParam(':name', $owner_name); // Added name here
                $stmt_confirm->execute();

                // Add notification
                $message = "Admin has confirmed the appointment of {$owner_name}.";
                $stmt = $conn->prepare("INSERT INTO notifications (email, type, message, code) VALUES (:email, :type, :message, :code)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':type', $new_status); 
                $stmt->bindParam(':message', $message);
                $stmt->bindParam(':code', $newCode);
                $stmt->execute();
            } elseif ($new_status === 'decline' || $new_status === 'complete') {
                // Update only status and insert into admin_confirm table
                $stmt = $conn->prepare("UPDATE appointments SET status = :status WHERE id = :id");
                $stmt->bindParam(':status', $new_status);
                $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
                $stmt->execute();

                // Insert into admin_confirm table
                $stmt_confirm = $conn->prepare("INSERT INTO admin_confirm (email, status, name) VALUES (:email, :status, :name)");
                $stmt_confirm->bindParam(':email', $email);
                $stmt_confirm->bindParam(':status', $new_status);
                $stmt_confirm->bindParam(':name', $owner_name);
                $stmt_confirm->execute();

                // Add notification
                if ($new_status === 'decline') {
                    $message = 'Your appointment has been rejected.';
                } elseif ($new_status === 'complete') {
                    $message = 'Your appointment has been completed.';
                }

                $stmt = $conn->prepare("INSERT INTO notifications (email, type, message, code) VALUES (:email, :type, :message, :code)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':type', $new_status); 
                $stmt->bindParam(':message', $message);
                $stmt->bindParam(':code', $code); 
                $stmt->execute();
            }

            echo json_encode(['success' => true, 'code' => $newCode ?? null]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
    $conn = null; 
}
?>
