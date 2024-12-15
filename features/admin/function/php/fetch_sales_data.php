<?php
require '../../../../db.php'; // Database connection

$todayData = array_fill(0, 7, 0); // Initialize 7 days of data for today
$yesterdayData = array_fill(0, 7, 0); // Initialize 7 days of data for yesterday

// Get data for Today
$stmtToday = $conn->prepare("
    SELECT DAYOFWEEK(created_at) AS day, SUM(total_payment) AS total 
    FROM appointments 
    WHERE DATE(created_at) = CURDATE() AND status = 'complete' 
    GROUP BY day
");
$stmtToday->execute();
$todayResults = $stmtToday->fetchAll(PDO::FETCH_ASSOC);
foreach ($todayResults as $row) {
    $todayData[$row['day'] - 1] = (int) $row['total'];
}

// Get data for Yesterday
$stmtYesterday = $conn->prepare("
    SELECT DAYOFWEEK(created_at) AS day, SUM(total_payment) AS total 
    FROM appointments 
    WHERE DATE(created_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND status = 'complete' 
    GROUP BY day
");
$stmtYesterday->execute();
$yesterdayResults = $stmtYesterday->fetchAll(PDO::FETCH_ASSOC);
foreach ($yesterdayResults as $row) {
    $yesterdayData[$row['day'] - 1] = (int) $row['total'];
}

// Return data as plain text (Today|Yesterday)
echo implode(',', $todayData) . '|' . implode(',', $yesterdayData);
?>
