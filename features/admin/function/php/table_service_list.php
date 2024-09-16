<?php
 try {
    
    $sql = "SELECT * FROM service_list";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($services) {
        foreach ($services as $service) {
            echo "<tr>";
            
            echo "<td>" . htmlspecialchars($service['id']) . "</td>"; 
            echo "<td>" . htmlspecialchars($service['service_type']) . "</td>"; 
            echo "<td>" . htmlspecialchars($service['service_name']) . "</td>";
            echo "<td>₱" . number_format($service['cost'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($service['discount']) . "%</td>";
            echo "<td>" . htmlspecialchars($service['info']) . "</td>";
            
            echo '<td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal' . $service['id'] . '"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal' . $service['id'] . '"><i class="fas fa-trash-alt"></i></button>
                  </td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No services found.</td></tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;


?>
