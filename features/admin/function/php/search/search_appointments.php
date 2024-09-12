<?php
require '../../../../../db.php';
// Get the search term from the AJAX request
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Default SQL query
$query = "SELECT * FROM appointments";

// Modify the query if a search term is provided
if (!empty($searchTerm)) {
    $query .= " WHERE 
                owner_name LIKE :searchTerm OR 
                contact_number LIKE :searchTerm OR 
                email LIKE :searchTerm OR 
                pet_type LIKE :searchTerm OR 
                breed LIKE :searchTerm OR 
                service_category LIKE :searchTerm OR 
                service_type LIKE :searchTerm";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
if (!empty($searchTerm)) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
}
$stmt->execute();

// Fetch the results
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the filtered results as table rows
if (count($appointments) > 0) {
    foreach ($appointments as $index => $appointment) {
        echo '<tr>
                <td>' . ($index + 1) . '</td>
                <td>' . $appointment['created_at'] . '</td>
                <td>' . ($appointment['code'] ?? 'Pending') . '</td>
                <td>' . $appointment['owner_name'] . '</td>
                <td>' . $appointment['contact_number'] . '</td>
                <td>' . $appointment['email'] . '</td>
                <td>' . $appointment['pet_type'] . '</td>
                <td>' . $appointment['breed'] . '</td>
                <td>' . $appointment['age'] . ' Yr Old</td>
                <td>' . $appointment['service_category'] . '</td>
                <td>' . $appointment['service_type'] . '</td>
                <td>' . $appointment['appointment_date'] . '</td>
                <td>' . $appointment['appointment_time'] . '</td>
                <td>' . number_format($appointment['total_payment'], 2) . ' PHP</td>
                <td>
                    <span class="badge bg-' . ($appointment['status'] == 'confirm' ? 'success' : ($appointment['status'] == 'complete' ? 'info' : ($appointment['status'] == 'decline' ? 'danger' : 'primary'))) . '">
                        ' . ucfirst($appointment['status']) . '
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton' . $index . '" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $index . '">
                            <li><a class="dropdown-item" href="#" onclick="updateStatus(' . $appointment['id'] . ', \'confirm\')">Confirm</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateStatus(' . $appointment['id'] . ', \'complete\')">Complete</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateStatus(' . $appointment['id'] . ', \'decline\')">Decline</a></li>
                        </ul>
                    </div>
                </td>
              </tr>';
    }
} else {
    echo '<tr><td colspan="16" class="text-center">No results found</td></tr>';
}


?>