<?php
require '../../../../db.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../../PHPMailer/src/Exception.php';
require '../../../../PHPMailer/src/PHPMailer.php';
require '../../../../PHPMailer/src/SMTP.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['id'] ?? '';
    $decline_reason = $_POST['declineReason'] ?? ''; 

    if (!empty($appointment_id) && !empty($decline_reason)) {
        try {
            // Fetch the email and owner_name from the appointment table
            $stmt = $conn->prepare("SELECT email, owner_name FROM appointments WHERE id = :id");
            $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
            $stmt->execute();
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $appointment['email'] ?? '';
            $owner_name = $appointment['owner_name'] ?? '';

            // Update the status to 'decline' and store the decline reason
            $stmt = $conn->prepare("UPDATE appointments SET status = 'decline', reason_cancel = :decline_reason WHERE id = :id");
            $stmt->bindParam(':decline_reason', $decline_reason);
            $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
            $stmt->execute();

            // Insert a notification record
            $message = "Your appointment has been declined.<br> Reason: $decline_reason";
            $status = 'decline'; // Assign 'decline' to a variable
            $stmt_notification = $conn->prepare("INSERT INTO notifications (email, type, message) VALUES (:email, :type, :message)");
            $stmt_notification->bindParam(':email', $email);
            $stmt_notification->bindParam(':type', $status); // Now passing the variable correctly
            $stmt_notification->bindParam(':message', $message);
            $stmt_notification->execute();

            // Insert into admin_confirm table
            $stmt_admin_confirm = $conn->prepare("INSERT INTO admin_confirm (name, status, email) VALUES (:name, :status, :email)");
            $stmt_admin_confirm->bindParam(':name', $owner_name);
            $stmt_admin_confirm->bindParam(':status', $status);
            $stmt_admin_confirm->bindParam(':email', $email);
            $stmt_admin_confirm->execute();

            // Send email notification
            sendDeclineEmail($email, $message); // Call the email function to send the decline email

            // Redirect after successful submission
            header('Location: ../../web/api/app-req.php');  
            exit();
        } catch (PDOException $e) {
            echo 'failure'; 
        }
    } else {
        echo 'failure'; 
    }
    $conn = null;
}

// Function to send the decline email
function sendDeclineEmail($email, $message) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ejivancablanida@gmail.com'; // Your email address
        $mail->Password   = 'acjf ngko qlfb cuju'; // Your email password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('Barkyards@gmail.com', 'Barks Yards');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Decline Notification';
        $mail->Body    = $message; // The decline message body

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
