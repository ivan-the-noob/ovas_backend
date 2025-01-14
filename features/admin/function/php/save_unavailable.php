<?php
require '../../../../db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = htmlspecialchars(trim($_POST['start_date']));
    $endDate = htmlspecialchars(trim($_POST['end_date'])); 
    $reason = htmlspecialchars(trim($_POST['reason']));

    if (!empty($startDate) && !empty($endDate) && !empty($reason)) {
        try {
            if ($conn) {
                $start = new DateTime($startDate);
                $end = new DateTime($endDate);
                $interval = new DateInterval('P1D'); 
                $dateRange = new DatePeriod($start, $interval, $end->add(new DateInterval('P1D'))); // Add 1 day to include the end date

                $stmt = $conn->prepare("INSERT INTO unavailable (unavailable, reason) VALUES (:unavailable, :reason)");

                foreach ($dateRange as $date) {
                    $unavailableDate = $date->format('Y-m-d'); 
                    $stmt->bindParam(':unavailable', $unavailableDate);
                    $stmt->bindParam(':reason', $reason);

                    if (!$stmt->execute()) {
                        echo "Failed to add unavailable status for " . $unavailableDate;
                        exit;
                    }
                }

                header("Location: ../../web/api/unavailable.php?message=Unavailable status added successfully");
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all the fields.";
    }
}
?>
