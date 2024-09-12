<?php
// Include the database connection
require '../../../../../db.php'; // Adjust the path to your db connection file

// Get the search term from the AJAX request (search only by owner_name)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Default SQL query to fetch all records from the correct table (pos_records)
$query = "SELECT * FROM pos_records";

// Modify the query if a search term is provided to filter by owner_name
if (!empty($searchTerm)) {
    $query .= " WHERE LOWER(owner_name) LIKE LOWER(:searchTerm)";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
if (!empty($searchTerm)) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
}
$stmt->execute();

// Fetch the results
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If there are matching records, display them
if (count($records) > 0) {
    foreach ($records as $record) {
        // Decode JSON fields (services, cost, medication, supplies)
        $services = json_decode($record['services'], true);
        $costs = json_decode($record['cost'], true);
        $medications = json_decode($record['medication'], true);
        $supplies = json_decode($record['supplies'], true);
        $total = !empty($record['total']) && is_numeric($record['total']) ? number_format($record['total'], 2) : '0.00';
        
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Thank you, <span class="fw-bold">' . htmlspecialchars($record['owner_name']) . '.</span></h5>';

        // Services Section
        if (is_array($services) && is_array($costs)) {
            echo '<div class="mb-3">';
            echo '<label for="service" class="form-label fw-bold">Services:</label>';
            foreach ($services as $index => $service) {
                echo '<div class="d-flex justify-content-between">';
                echo '<span id="service">' . htmlspecialchars($service) . '</span>';
                echo '<span>₱ ' . (isset($costs[$index]) ? number_format((float)$costs[$index], 2) : '0.00') . '</span>';
                echo '</div>';
            }
            echo '</div>';
        }

        // Medications Section
        if (!empty($medications)) {
            echo '<div class="mb-3">';
            echo '<label for="medication" class="form-label fw-bold">Add Medication or Supplies:</label>';
            foreach ($medications as $medication) {
                echo '<div class="d-flex justify-content-between">';
                echo '<span id="medication">' . htmlspecialchars($medication) . '</span>';
                echo '<span>₱ 25.00</span>';
                echo '</div>';
            }
            echo '</div>';
        }

        // Supplies Section
        if (!empty($supplies)) {
            echo '<div class="mb-3">';
            echo '<label for="supplies" class="form-label fw-bold">Supplies:</label>';
            foreach ($supplies as $supply) {
                echo '<div class="d-flex justify-content-between">';
                echo '<span id="supplies">' . htmlspecialchars($supply) . '</span>';
                echo '<span>₱ 299.00</span>';
                echo '</div>';
            }
            echo '</div>';
        }

        // Total Section
        echo '<div class="d-flex justify-content-between fw-bold">';
        echo '<span>TOTAL:</span>';
        echo '<span>₱ ' . $total . '</span>';
        echo '</div>';
        
        // Buttons Section
        echo '<div class="buttons d-flex justify-content-center gap-2">';
        echo '<button>Print</button>';
        echo '<button class="paid">Paid</button>';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    // If no results are found, display a message
    echo '<div class="col-12 text-center">No results found</div>';
}
?>
