<?php
// Include database connection
require '../../../../db.php';
require '../../../../PHPMailer/src/Exception.php';
require '../../../../PHPMailer/src/PHPMailer.php';
require '../../../../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get the POST data
$appointment_date = $_POST['appointment_date'];
$status = $_POST['status'];
$email = $_POST['email']; // Assuming you are passing the email

// Prepare the SQL query to update the appointment based on email
$query = "UPDATE appointments SET appointment_date = :appointment_date, status = :status WHERE email = :email";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind parameters
$stmt->bindParam(':appointment_date', $appointment_date);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':email', $email); // Bind the email parameter

// Execute the statement
if ($stmt->execute()) {
    // If the update is successful
    echo 'success';
    
    // Insert into notifications table
    $notificationQuery = "INSERT INTO notifications (email, type, message) VALUES (:email, 'Success', 'You successfully booked! Please wait for confirmation.')";
    $notificationStmt = $conn->prepare($notificationQuery);
    $notificationStmt->bindParam(':email', $email);
    $notificationStmt->execute();

    // Insert into admin_confirm table
    $adminConfirmQuery = "INSERT INTO admin_confirm (name, status, email) VALUES (:name, :status, :email)";
    $adminConfirmStmt = $conn->prepare($adminConfirmQuery);
    $adminConfirmStmt->bindParam(':name', $status); // Assuming the status is the name of the person making the appointment
    $adminConfirmStmt->bindParam(':status', $status); // Assuming the status is being used for this column as well
    $adminConfirmStmt->bindParam(':email', $email);
    $adminConfirmStmt->execute();

    // Send email notification
    sendAppointmentEmail($email, '', 'You have successfully booked an appointment.');

    // Redirect after successful update
    header("Location: ../../web/api/appointments.php?message=Appointment confirmed successfully.");
    exit; // Don't forget to call exit after header to prevent further script execution
} else {
    // If there's an issue with the update
    echo 'error'; 
}

// Close the statement and connection
$stmt = null;
$conn = null;

// Function to send appointment email
function sendAppointmentEmail($email, $code, $message) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ejivancablanida@gmail.com'; 
        $mail->Password   = 'acjf ngko qlfb cuju'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('Barkyards@gmail.com', 'Barks Yards');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Status Update';
        $mail->Body    = "$message Your code is: $code";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
