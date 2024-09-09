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
            header('Location: ../../web/api/appointment.php');
            exit; 
        } else {
            echo "Error booking appointment!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
