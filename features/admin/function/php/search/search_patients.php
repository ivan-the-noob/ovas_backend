<?php
// Include the database connection
require '../../../../../db.php';

// Get the search term from the AJAX request
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Default SQL query to fetch all records from the correct table (patients_records)
$query = "SELECT * FROM patients_records";

// Modify the query if a search term is provided to filter by ownerName
if (!empty($searchTerm)) {
    $query .= " WHERE LOWER(ownerName) LIKE LOWER(:searchTerm)";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
if (!empty($searchTerm)) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
}
$stmt->execute();

// Fetch the results
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If there are matching patients, display them
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
    // If no results are found, display a message
    echo '<div class="col-12 text-center">No results found</div>';
}
?>
