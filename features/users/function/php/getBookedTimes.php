<?php
require '../../../../db.php'; // Adjust the path as necessary

$date = isset($_POST['date']) ? $_POST['date'] : '';

// Prepare and execute the query to get the appointment times for the selected date
$sql = "SELECT appointment_time FROM appointments WHERE appointment_date = :date";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->execute();

// Fetch all appointment times
$appointment_times = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Return the appointment times as a comma-separated string
echo implode(',', $appointment_times);

// Close the connection
$stmt = null;
?>
