<?php
require '../../../../db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); 
    $ownerName = $_POST['ownerName'];
    $ownerAddress = $_POST['ownerAddress'];
    $home = $_POST['home'];
    $work = $_POST['work'];
    $ownerEmail = $_POST['ownerEmail'];
    $preferredContact = $_POST['preferredContact'];
    $petName = $_POST['petName'];
    $petType = $_POST['petType'];
    $sex = $_POST['sex'];
    $breed = $_POST['breed'];
    $colorMarkings = $_POST['colorMarkings'];
    $microchipNo = $_POST['microchipNo'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $serviceCategory = $_POST['serviceCategory'];
    $service = $_POST['service'];
    $totalPayment = $_POST['totalPayment'];
    $date = $_POST['date'];
    $authorization = $_POST['authorization'];
    $enteringComplaint = $_POST['enteringComplaint'];
    $historyPhysical = $_POST['historyPhysical'];

    // Prepare and execute the statement
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

    // Execute the statement with bound parameters
    if ($stmt->execute([
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
    ])) {
        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Patient information updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No changes made. Please check if the data is different.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed: ' . $stmt->errorInfo()[2]]);
    }

    // Close the connection
    $conn = null;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
