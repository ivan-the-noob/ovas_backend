<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $ownerName = trim($_POST['ownerName']);
    $ownerAddress = trim($_POST['ownerAddress']);
    $home = trim($_POST['home']);
    $work = trim($_POST['work']);
    $ownerEmail = filter_input(INPUT_POST, 'ownerEmail', FILTER_VALIDATE_EMAIL);
    $preferredContact = trim($_POST['preferredContact']);
    $petName = trim($_POST['petName']);
    $petType = trim($_POST['petType']);
    $sex = trim($_POST['sex']);
    $breed = trim($_POST['breed']);
    $colorMarkings = trim($_POST['colorMarkings']);
    $microchipNo = trim($_POST['microchipNo']);
    $dob = trim($_POST['dob']);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $serviceCategory = trim($_POST['serviceCategory']);
    $service = trim($_POST['service']);
    $totalPayment = filter_input(INPUT_POST, 'totalPayment', FILTER_VALIDATE_FLOAT);
    $date = trim($_POST['date']);
    $authorization = trim($_POST['authorization']);
    $enteringComplaint = trim($_POST['enteringComplaint']);
    $historyPhysical = trim($_POST['historyPhysical']);

    

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE patients_records SET 
            ownerName = ?, 
            ownerAddress = ?, 
            home = ?, 
            work = ?, 
            ownerEmail = ?, 
            preferredContact = ?, 
            petName = ?, 
            petType = ?, 
            sex = ?, 
            breed = ?, 
            colorMarkings = ?, 
            microchipNo = ?, 
            dob = ?, 
            age = ?, 
            serviceCategory = ?, 
            service = ?, 
            totalPayment = ?, 
            date = ?, 
            authorization = ?, 
            enteringComplaint = ?, 
            historyPhysical = ? 
        WHERE id = ?");

        // Bind parameters and execute the statement
        $result = $stmt->execute([
            $ownerName, 
            $ownerAddress, 
            $home, 
            $work, 
            $ownerEmail, 
            $preferredContact, 
            $petName, 
            $petType, 
            $sex, 
            $breed, 
            $colorMarkings, 
            $microchipNo, 
            $dob, 
            $age, 
            $serviceCategory, 
            $service, 
            $totalPayment, 
            $date, 
            $authorization, 
            $enteringComplaint, 
            $historyPhysical, 
            $id
        ]);

        
        if ($result) {
            if ($stmt->rowCount() > 0) {
                header('Location: ../../web/api/app-records-list.php?status=success');
                exit;  
            } else {
                echo json_encode(['status' => 'info', 'message' => 'No changes were made.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update the record.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    } finally {
        $conn = null;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
