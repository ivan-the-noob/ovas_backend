<?php
session_start();
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture the form data
    $owner_name = $_POST['ownerName'] ?? '';
    $contact_number = $_POST['contactNum'] ?? '';
    $email = $_POST['ownerEmail'] ?? '';
    $address = $_POST['ownerAddress'] ?? '';
    $pet_type = $_POST['petType'] ?? '';
    $breed = $_POST['breed'] ?? '';
    $age = $_POST['age'] ?? 0;
    $selected_service = $_POST['selectedService'] ?? ''; 
    $total_payment = floatval($_POST['servicePrice'] ?? 0);
    $service_category = $_POST['serviceCategory'] ?? '';
    $appointment_time = $_POST['appointmentTime'] ?? '';
    $appointment_date = $_POST['appointmentDate'] ?? ''; 

    try {
        // Insert the appointment into the database
        $stmt = $conn->prepare("INSERT INTO appointments 
            (owner_name, contact_number, email, address, pet_type, breed, age, service_category, service_type, appointment_time, appointment_date, total_payment)
            VALUES (:owner_name, :contact_number, :email, :address, :pet_type, :breed, :age, :service_category, :service_type, :appointment_time, :appointment_date, :total_payment)");

        $stmt->bindParam(':owner_name', $owner_name);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':pet_type', $pet_type);
        $stmt->bindParam(':breed', $breed);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->bindParam(':service_category', $service_category);
        $stmt->bindParam(':service_type', $selected_service);
        $stmt->bindParam(':appointment_time', $appointment_time);
        $stmt->bindParam(':appointment_date', $appointment_date); 
        $stmt->bindParam(':total_payment', $total_payment, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Insert the notification after booking is successful
            $notification_stmt = $conn->prepare("INSERT INTO notifications 
                (email, type, message) VALUES (:email, :type, :message)");

            $type = 'Success';
            $message = 'You successfully booked! Please wait for confirmation.';

            $notification_stmt->bindParam(':email', $email);
            $notification_stmt->bindParam(':type', $type);
            $notification_stmt->bindParam(':message', $message);

            if ($notification_stmt->execute()) {
                // Store the success message in session
                $_SESSION['success_message'] = '<div class="notification-content alert-primary">
                    <strong>Successfully Booked!</strong>
                    <p class="notification-text">You successfully booked! Please Wait for Confirmation</p>
                </div>';
                
                // Redirect to appointment page
                header('Location: ../../web/api/appointment.php');
                exit;
            } else {
                echo "Error adding notification!";
            }
        } else {
            echo "Error booking appointment!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
