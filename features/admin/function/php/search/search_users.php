<?php
require '../../../../../db.php'; 

$search = $_POST['search'] ?? '';


$query = "SELECT * FROM users WHERE name LIKE ? OR email LIKE ? ORDER BY id ASC";

try {
    $stmt = $conn->prepare($query);
    $searchTerm = '%' . $search . '%';
    $stmt->execute([$searchTerm, $searchTerm]);

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($users)) {
        foreach ($users as $index => $user) {
            echo "<tr>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td><img src='../../../../assets/img/customer.jfif' alt='Avatar'></td>";
            echo "<td>" . htmlspecialchars($user['name']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "<td>" . ucfirst(htmlspecialchars($user['role'])) . "</td>";
            echo '<td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal-' . $user['id'] . '">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal-' . $user['id'] . '">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                  </td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
