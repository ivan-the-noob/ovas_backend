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
        echo '<button type="button" class="view" data-toggle="modal" data-target="#modal' . $patient['id'] . '">View</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    
    echo '<div class="col-12 text-center">No results found</div>';
}
?>
