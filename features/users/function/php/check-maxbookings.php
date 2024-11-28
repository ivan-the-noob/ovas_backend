<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $date = $_POST['date'];

        // Get the max booking limit
        $stmt = $pdo->query("SELECT max_booking FROM max_booking LIMIT 1");
        $maxBookingRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxBooking = $maxBookingRow ? intval($maxBookingRow['max_booking']) : 10; // Default to 2 if not found

        // Get the booking count for the given date
        $stmt = $pdo->prepare("SELECT COUNT(*) as booking_count FROM bookings WHERE booking_date = :date");
        $stmt->execute(['date' => $date]);
        $bookingRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $bookingCount = $bookingRow ? intval($bookingRow['booking_count']) : 0;

        // Return the response as JSON
        echo json_encode([
            'bookingCount' => $bookingCount,
            'maxBooking' => $maxBooking
        ]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
