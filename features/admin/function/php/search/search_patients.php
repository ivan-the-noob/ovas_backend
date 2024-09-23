<?php

require '../../../../../db.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM patients_records";

if (!empty($searchTerm)) {
    $query .= " WHERE LOWER(ownerName) LIKE LOWER(:searchTerm)";
}

$stmt = $conn->prepare($query);
if (!empty($searchTerm)) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
}
$stmt->execute();

$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($patients) > 0) {
    foreach ($patients as $patient) {
        echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">' . htmlspecialchars($patient['ownerName']) . '</h5>';
        echo '<button type="button" class="view" data-bs-toggle="modal" data-bs-target="#modal' . $patient['id'] . '">View</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Modal for each patient
        echo '<div class="modal fade" id="modal' . $patient['id'] . '" tabindex="-1" aria-labelledby="modalLabel' . $patient['id'] . '" aria-hidden="true">';
        echo '<div class="modal-dialog modal-lg" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header justify-content-between">';
        echo '<h5 class="modal-title" id="modalLabel' . $patient['id'] . '">Details for ' . htmlspecialchars($patient['ownerName']) . '</h5>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '</div>';
        echo '<div class="container p-4">';
        echo '<div class="row">';
        
        // First Column
        echo '<div class="col-lg-3 col-md-6 mb-3">';
        echo '<h6>Client Information</h6>';
        echo '<p><strong>Name:</strong> <span class="text-view" id="ownerName-text-' . $patient['id'] . '">' . htmlspecialchars($patient['ownerName']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="ownerName-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['ownerName']) . '" style="display:none;"></p>';
        echo '<p><strong>Address:</strong> <span class="text-view" id="ownerAddress-text-' . $patient['id'] . '">' . htmlspecialchars($patient['ownerAddress']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="ownerAddress-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['ownerAddress']) . '" style="display:none;"></p>';
        echo '<p><strong>Contact:</strong></p>';
        echo '<p><strong>Home:</strong> <span class="text-view" id="home-text-' . $patient['id'] . '">' . htmlspecialchars($patient['home']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="home-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['home']) . '" style="display:none;"></p>';
        echo '<p><strong>Work:</strong> <span class="text-view" id="work-text-' . $patient['id'] . '">' . htmlspecialchars($patient['work']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="work-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['work']) . '" style="display:none;"></p>';
        echo '<p><strong>Email:</strong> <span class="text-view" id="ownerEmail-text-' . $patient['id'] . '">' . htmlspecialchars($patient['ownerEmail']) . '</span>';
        echo '<input type="email" class="form-control edit-view" id="ownerEmail-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['ownerEmail']) . '" style="display:none;"></p>';
        echo '<p><strong>Preferred:</strong> <span class="text-view" id="preferredContact-text-' . $patient['id'] . '">' . htmlspecialchars($patient['preferredContact']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="preferredContact-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['preferredContact']) . '" style="display:none;"></p>';
        echo '</div>'; // Close First Column

        // Second Column
        echo '<div class="col-lg-3 col-md-6 mb-3">';
        echo '<h6>Pet Information</h6>';
        echo '<p><strong>Pet\'s Name:</strong> <span class="text-view" id="petName-text-' . $patient['id'] . '">' . htmlspecialchars($patient['petName']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="petName-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['petName']) . '" style="display:none;"></p>';
        echo '<p><strong>Species:</strong> <span class="text-view" id="petType-text-' . $patient['id'] . '">' . htmlspecialchars($patient['petType']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="petType-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['petType']) . '" style="display:none;"></p>';
        echo '<p><strong>Sex:</strong> <span class="text-view" id="sex-text-' . $patient['id'] . '">' . htmlspecialchars($patient['sex']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="sex-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['sex']) . '" style="display:none;"></p>';
        echo '<p><strong>Breed:</strong> <span class="text-view" id="breed-text-' . $patient['id'] . '">' . htmlspecialchars($patient['breed']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="breed-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['breed']) . '" style="display:none;"></p>';
        echo '<p><strong>Colors & Marking:</strong> <span class="text-view" id="colorMarkings-text-' . $patient['id'] . '">' . htmlspecialchars($patient['colorMarkings']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="colorMarkings-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['colorMarkings']) . '" style="display:none;"></p>';
        echo '<p><strong>Microchip No.:</strong> <span class="text-view" id="microchipNo-text-' . $patient['id'] . '">' . htmlspecialchars($patient['microchipNo']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="microchipNo-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['microchipNo']) . '" style="display:none;"></p>';
        echo '<p><strong>Date of Birth:</strong> <span class="text-view" id="dob-text-' . $patient['id'] . '">' . htmlspecialchars($patient['dob']) . '</span>';
        echo '<input type="date" class="form-control edit-view" id="dob-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['dob']) . '" style="display:none;"></p>';
        echo '<p><strong>Age:</strong> <span class="text-view" id="age-text-' . $patient['id'] . '">' . htmlspecialchars($patient['age']) . '</span>';
        echo '<input type="number" class="form-control edit-view" id="age-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['age']) . '" style="display:none;"></p>';
        echo '</div>'; // Close Second Column

        // Third Column
        echo '<div class="col-lg-3 col-md-6 mb-3">';
        echo '<h6>Services</h6>';
        echo '<p><strong>Category:</strong> <span class="text-view" id="serviceCategory-text-' . $patient['id'] . '">' . htmlspecialchars($patient['serviceCategory']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="serviceCategory-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['serviceCategory']) . '" style="display:none;"></p>';
        echo '<p><strong>Services:</strong> <span class="text-view" id="service-text-' . $patient['id'] . '">' . htmlspecialchars($patient['service']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="service-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['service']) . '" style="display:none;"></p>';
        echo '<p><strong>Total Payment:</strong> <span class="text-view" id="totalPayment-text-' . $patient['id'] . '">₱' . htmlspecialchars($patient['totalPayment']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="totalPayment-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['totalPayment']) . '" style="display:none;"></p>';
        echo '</div>'; // Close Third Column

        // Fourth Column
        echo '<div class="col-lg-3 col-md-6 mb-3">';
        echo '<h6>Other Information</h6>';
        echo '<p><strong>Date:</strong> <span class="text-view" id="date-text-' . $patient['id'] . '">' . htmlspecialchars($patient['date']) . '</span>';
        echo '<input type="date" class="form-control edit-view" id="date-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['date']) . '" style="display:none;"></p>';
        echo '<p><strong>Authorization for Treatment:</strong> <span class="text-view" id="authorization-text-' . $patient['id'] . '">' . htmlspecialchars($patient['authorization']) . '</span>';
        echo '<input type="text" class="form-control edit-view" id="authorization-input-' . $patient['id'] . '" value="' . htmlspecialchars($patient['authorization']) . '" style="display:none;"></p>';
        echo '<p><strong>Veterinarian\'s Report:</strong><br> <span class="text-view" id="enteringComplaint-text-' . $patient['id'] . '">' . nl2br(htmlspecialchars($patient['enteringComplaint'])) . '</span>';
        echo '<textarea class="form-control edit-view" id="enteringComplaint-input-' . $patient['id'] . '" style="display:none;">' . htmlspecialchars($patient['enteringComplaint']) . '</textarea></p>';
        echo '<p><strong>History • Physical Findings • Diagnosis • Treatment:</strong><br>';
        echo '<span class="text-view" id="historyPhysical-text-' . $patient['id'] . '">' . nl2br(htmlspecialchars($patient['historyPhysical'])) . '</span>';
        echo '<textarea class="form-control edit-view" id="historyPhysical-input-' . $patient['id'] . '" style="display:none;">' . htmlspecialchars($patient['historyPhysical']) . '</textarea></p>';
        echo '<div class="mb-3">';
        echo '<button class="btn toggle-edit-btn" data-patient-id="' . $patient['id'] . '">Update</button>';
        echo '</div>';
        echo '</div>'; // Close Fourth Column

        echo '</div>'; // Close Row
        echo '</div>'; // Close Container
        echo '</div>'; // Close Modal Content
        echo '</div>'; // Close Modal Dialog
        echo '</div>'; // Close Patient Card
    }
} else {
    echo '<p>No results found.</p>';
}

?>
