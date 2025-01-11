<?php
require '../../../../db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collecting form data
    $ownerName = $_POST['ownerName'] ?? null;
    $ownerMiddleName = $_POST['ownerMiddleName'] ?? null;
    $ownerLastName = $_POST['ownerLastName'] ?? null;
    $ownerAddress = $_POST['ownerAddress'] ?? null;
    $mobile = $_POST['mobile'] ?? null;
    $ownerEmail = $_POST['ownerEmail'] ?? null;

    // Pet Information
    $petName = $_POST['petName'] ?? null;
    $petType = $_POST['petType'] ?? null;
    $breed = $_POST['breed'] ?? null;
    $sex = $_POST['sex'] ?? null;
    $microchipNo = $_POST['microchipNo'] ?? null;
    $colorMarkings = $_POST['colorMarkings'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $age = $_POST['age'] ?? null;

    // Medical History
    $previous_veteran = $_POST['previous_veteran'] ?? null;
    $health_insurance = $_POST['health_insurance'] ?? null;
    $drug_allergies = $_POST['drug_allergies'] ?? null;
    $illness_surgeries = $_POST['illness_surgeries'] ?? null;
    $cur_medications = $_POST['cur_medications'] ?? null;
    $diet_restrictions = $_POST['diet_restrictions'] ?? null;
    $initial_visits = $_POST['initial_visits'] ?? null;

    // Other Information
    $vet_name = $_POST['vet_name'] ?? null;
    $authorization = $_POST['authorization'] ?? null;
    $vet_report = $_POST['vet_report'] ?? null;
    $historyPhysical = $_POST['historyPhysical'] ?? null;
    $date_return = $_POST['date_return'] ?? null;

    // Check for required fields
    if (empty($ownerName) || empty($ownerLastName) || empty($mobile) || empty($ownerEmail) || empty($petName) || empty($petType) || empty($sex) || empty($authorization) || empty($date_return)) {
        echo "All required fields must be filled!";
        exit;
    }

    try {
        // Prepare SQL Query
        $sql = "INSERT INTO patients_records (ownerName, ownerMiddleName, ownerLastName, ownerAddress, mobile, ownerEmail, 
        petName, petType, breed, sex, microchipNo, colorMarkings, dob, age, previous_veteran, health_insurance, drug_allergies, 
        illness_surgeries, cur_medications, diet_restrictions, initial_visits, vet_name, authorization, vet_report, historyPhysical, 
        date_return) 
        VALUES (:ownerName, :ownerMiddleName, :ownerLastName, :ownerAddress, :mobile, :ownerEmail, 
        :petName, :petType, :breed, :sex, :microchipNo, :colorMarkings, :dob, :age, :previous_veteran, :health_insurance, 
        :drug_allergies, :illness_surgeries, :cur_medications, :diet_restrictions, :initial_visits, :vet_name, 
        :authorization, :vet_report, :historyPhysical, :date_return)";
        
        // Prepare PDO statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':ownerName', $ownerName);
        $stmt->bindParam(':ownerMiddleName', $ownerMiddleName);
        $stmt->bindParam(':ownerLastName', $ownerLastName);
        $stmt->bindParam(':ownerAddress', $ownerAddress);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':ownerEmail', $ownerEmail);
        $stmt->bindParam(':petName', $petName);
        $stmt->bindParam(':petType', $petType);
        $stmt->bindParam(':breed', $breed);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':microchipNo', $microchipNo);
        $stmt->bindParam(':colorMarkings', $colorMarkings);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':previous_veteran', $previous_veteran);
        $stmt->bindParam(':health_insurance', $health_insurance);
        $stmt->bindParam(':drug_allergies', $drug_allergies);
        $stmt->bindParam(':illness_surgeries', $illness_surgeries);
        $stmt->bindParam(':cur_medications', $cur_medications);
        $stmt->bindParam(':diet_restrictions', $diet_restrictions);
        $stmt->bindParam(':initial_visits', $initial_visits);
        $stmt->bindParam(':vet_name', $vet_name);
        $stmt->bindParam(':authorization', $authorization);
        $stmt->bindParam(':vet_report', $vet_report);
        $stmt->bindParam(':historyPhysical', $historyPhysical);
        $stmt->bindParam(':date_return', $date_return);

        // Execute the statement
        $stmt->execute();

       header('Location:../../web/api/app-records-list.php');

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection (optional as PDO connection will be closed automatically)
    $conn = null;
}
?>
