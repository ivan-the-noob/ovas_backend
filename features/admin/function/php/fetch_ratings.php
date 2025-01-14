<?php
require '../../../../db.php';

$sql = "SELECT rating FROM reviews";
$stmt = $conn->prepare($sql);
$stmt->execute();

$ratings = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $ratings[] = $row['rating'];
}

$conn = null;

echo implode(',', $ratings);
?>
