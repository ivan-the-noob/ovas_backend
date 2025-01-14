<?php
header('Content-Type: text/plain');
require '../../../../db.php';

if ($_POST['action'] === 'fetchUnavailable') {
    try {
        $query = "SELECT `unavailable` FROM `unavailable`";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $dates = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dates[] = $row['unavailable'];
        }

        $today = new DateTime(); 
        $maxDate = new DateTime('+14 days'); 

        while ($today <= $maxDate) {
            if ($today->format('N') == 7) {
                $dates[] = $today->format('Y-m-d'); 
            }
            $today->modify('+1 day'); 
        }

        echo implode(',', $dates);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
