<?php
require '../../../../db.php'; 

try {
    // Update all notifications to "read"
    $sql = "UPDATE admin_confirm SET `read` = '1' WHERE `read` = '0'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
