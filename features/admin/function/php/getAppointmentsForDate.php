<?php
require '../../../../db.php';

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    try {
        $sql = "SELECT * FROM appointments WHERE appointment_date = :date";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();

        $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($appointments) > 0) {
            // Build HTML output for each appointment
            foreach ($appointments as $appointment) {
                echo "<div class='appointment-details'>
                        
                        <p><strong>Owner:</strong> " . htmlspecialchars($appointment['owner_name']) . "</p>
                        <p><strong>Code:</strong> " . htmlspecialchars($appointment['code']) . "</p>
                        <p><strong>Pet:</strong> " . htmlspecialchars($appointment['pet_type']) . ", " . htmlspecialchars($appointment['age']) . " Yr(s) Old</p>
                        <p><strong>Service:</strong> " . htmlspecialchars($appointment['service_type']) . "</p>
                        <p><strong>Time:</strong> " . htmlspecialchars($appointment['appointment_time']) . "</p>
                        <p><strong>Status:</strong> " . htmlspecialchars($appointment['status']) . "</p>
                        <a href='../../web/api/app-req.php'class='btn btn-primary'>View</a>
                    </div><hr />";
            }
        } else {
            echo "<p>No appointments found for this date.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error fetching appointment details.</p>";
    }
}
?>
