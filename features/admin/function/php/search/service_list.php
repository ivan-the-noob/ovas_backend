<?php
require '../../../../../db.php';  // Ensure this path is correct for your environment

$search = $_POST['search'] ?? '';

// Query to filter services by service_type, service_name, or info fields
$query = "SELECT * FROM service_list 
          WHERE service_type LIKE ? OR service_name LIKE ? OR info LIKE ? 
          ORDER BY id ASC";

try {
    // Prepare the statement with the connection object `$conn`
    $stmt = $conn->prepare($query);

    // Bind the search term to all the placeholders in the SQL query
    $searchTerm = '%' . $search . '%';
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);

    // Fetch all the matching results
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are any results
    if (!empty($services)) {
        foreach ($services as $service) {
           echo "<tr>";
            // Use the database ID for the first column
            echo "<td>" . htmlspecialchars($service['id']) . "</td>"; 
            echo "<td>" . htmlspecialchars($service['service_type']) . "</td>"; 
            echo "<td>" . htmlspecialchars($service['service_name']) . "</td>"; 
            echo "<td>₱" . number_format($service['cost'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($service['discount']) . "%</td>";
            echo "<td>" . htmlspecialchars($service['info']) . "</td>";
            echo '<td>
                    <button type="button" data-toggle="modal" data-target="#editModal' . $service['id'] . '" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#deleteModal' . $service['id'] . '" title="Delete" style="color: red;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                  </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="7">No services found</td></tr>';
    }
} catch (PDOException $e) {
    // Handle any errors in the query
    echo "Error: " . $e->getMessage();
}
?>
