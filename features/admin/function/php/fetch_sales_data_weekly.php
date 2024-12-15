<?php
require '../../../../db.php'; // Database connection

// Initialize arrays for 7 days of data for this week and last week
$thisWeekData = array_fill(0, 7, 0); // Initialize for current week
$lastWeekData = array_fill(0, 7, 0); // Initialize for last week

// Get data for This Week
$stmtThisWeek = $conn->prepare("
    SELECT DAYOFWEEK(created_at) AS day, SUM(total_payment) AS total 
    FROM appointments 
    WHERE WEEK(created_at, 1) = WEEK(CURDATE(), 1) AND status = 'complete' 
    GROUP BY day
");
$stmtThisWeek->execute();
$thisWeekResults = $stmtThisWeek->fetchAll(PDO::FETCH_ASSOC);
foreach ($thisWeekResults as $row) {
    $thisWeekData[$row['day'] - 1] = (int) $row['total'];
}

// Get data for Last Week
$stmtLastWeek = $conn->prepare("
    SELECT DAYOFWEEK(created_at) AS day, SUM(total_payment) AS total 
    FROM appointments 
    WHERE WEEK(created_at, 1) = WEEK(DATE_SUB(CURDATE(), INTERVAL 1 WEEK), 1) AND status = 'complete' 
    GROUP BY day
");
$stmtLastWeek->execute();
$lastWeekResults = $stmtLastWeek->fetchAll(PDO::FETCH_ASSOC);
foreach ($lastWeekResults as $row) {
    $lastWeekData[$row['day'] - 1] = (int) $row['total'];
}

// Return data as plain text (ThisWeek|LastWeek)
echo implode(',', $thisWeekData) . '|' . implode(',', $lastWeekData);
?>
