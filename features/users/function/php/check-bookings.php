<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date'])) {
    $date = $_POST['date'];

    try {
        // Fetch the current booking count for the selected date
        $stmt = $conn->prepare("SELECT COUNT(*) AS booking_count FROM appointments WHERE appointment_date = :date");
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $bookingCount = $result['booking_count'] ?? 0;

        // Fetch the max booking count from the max_booking table (single row)
        $stmtMaxBooking = $conn->prepare("SELECT max_booking FROM max_booking LIMIT 1");
        $stmtMaxBooking->execute();
        $maxBooking = $stmtMaxBooking->fetch(PDO::FETCH_ASSOC);
        $maxBookingValue = $maxBooking['max_booking'] ?? 0;

        // Return the booking count and max booking as a JSON response
        echo json_encode([
            'bookingCount' => $bookingCount,
            'maxBooking' => $maxBookingValue // This is the same value for all dates
        ]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

    $conn = null;
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
