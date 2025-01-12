<?php

require '../../../../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated data from the form
    $ownerName = $_POST['ownerName'];
    $ownerMiddleName = $_POST['ownerMiddleName'];
    $ownerLastName = $_POST['ownerLastName'];
    $ownerAddress = $_POST['ownerAddress'];
    $mobile = $_POST['mobile'];
    $ownerEmail = $_POST['ownerEmail'];
    $petName = $_POST['petName'];
    $petType = $_POST['petType'];
    $breed = $_POST['breed'];
    $sex = $_POST['sex'];
    $microchipNo = $_POST['microchipNo'];
    $colorMarkings = $_POST['colorMarkings'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $previous_veteran = $_POST['previous_veteran'];
    $health_insurance = $_POST['health_insurance'];
    $drug_allergies = $_POST['drug_allergies'];
    $illness_surgeries = $_POST['illness_surgeries'];
    $cur_medications = $_POST['cur_medications'];
    $diet_restrictions = $_POST['diet_restrictions'];
    $initial_visits = $_POST['initial_visits'];
    $vet_name = $_POST['vet_name'];
    $authorization = $_POST['authorization'];
    $vet_report = $_POST['vet_report'];
    $historyPhysical = $_POST['historyPhysical'];
    $date_return = $_POST['date_return'];

    // Prepare the UPDATE SQL query
    $sql = "UPDATE patients_records SET 
                ownerName = :ownerName, 
                ownerMiddleName = :ownerMiddleName, 
                ownerLastName = :ownerLastName, 
                ownerAddress = :ownerAddress, 
                mobile = :mobile, 
                ownerEmail = :ownerEmail, 
                petName = :petName, 
                petType = :petType, 
                breed = :breed, 
                sex = :sex, 
                microchipNo = :microchipNo, 
                colorMarkings = :colorMarkings, 
                dob = :dob, 
                age = :age, 
                previous_veteran = :previous_veteran, 
                health_insurance = :health_insurance, 
                drug_allergies = :drug_allergies, 
                illness_surgeries = :illness_surgeries, 
                cur_medications = :cur_medications, 
                diet_restrictions = :diet_restrictions, 
                initial_visits = :initial_visits, 
                vet_name = :vet_name, 
                authorization = :authorization, 
                vet_report = :vet_report, 
                historyPhysical = :historyPhysical, 
                date_return = :date_return
            WHERE id = :id";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the query
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
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // If successful, redirect or display a success message
        header("Location: ../../web/api/app-records-liste.php"); // Replace with your redirect URL
        exit;
    } else {
        // Handle error if query execution fails
        echo "Error updating the record.";
    }
}
?>
