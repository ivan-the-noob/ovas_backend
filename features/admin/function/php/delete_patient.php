<?php
require '../../../../db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM patients_records WHERE id = ?");
    
    if ($stmt->execute([$id])) {
        header('Location: ../../web/api/app-records-list.php?status=success');
        exit; 
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Delete failed: ' . $stmt->errorInfo()[2]]);
    }

    $conn = null;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
