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
        echo implode(',', $dates);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
