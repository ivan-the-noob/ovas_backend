<?php

// Include the database connection
require '../../../../../db.php';

// Get the search term from POST request
$search = $_POST['search'] ?? '';

// Prepare the SQL query with LIKE to match categories
$query = "SELECT * FROM categories WHERE category_name LIKE ? ORDER BY id ASC";
$stmt = $conn->prepare($query); // Change $pdo to $conn
$stmt->execute(['%' . $search . '%']);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the results as table rows
if (!empty($categories)) {
    foreach ($categories as $category) {
        echo '<tr class="test-hover">';
        echo '<td>' . htmlspecialchars($category['id']) . '</td>';
        echo '<td>' . htmlspecialchars($category['category_name']) . '</td>';
        echo '<td>
                <button type="button" data-toggle="modal" data-target="#editModal' . $category['id'] . '" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" data-toggle="modal" data-target="#deleteModal' . $category['id'] . '" title="Delete" style="color: red;">
                    <i class="fas fa-trash-alt"></i>
                </button>
              </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="3">No categories found</td></tr>';
}
?>
