<?php
require '../../../../../db.php';  

$search = $_POST['search'] ?? '';


$query = "SELECT * FROM service_list 
          WHERE service_type LIKE ? OR service_name LIKE ? OR info LIKE ? 
          ORDER BY id ASC";

try {
    
    $stmt = $conn->prepare($query);

    
    $searchTerm = '%' . $search . '%';
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);

    
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    if (!empty($services)) {
        foreach ($services as $service) {
           echo "<tr>";
            
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
    
    echo "Error: " . $e->getMessage();
}
?>
