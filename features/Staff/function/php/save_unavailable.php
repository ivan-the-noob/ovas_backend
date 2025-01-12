<?php
require '../../../../db.php'; // Ensure correct path to db.php file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $unavailableDate = htmlspecialchars(trim($_POST['unavailable_date'])); // Date input
    $reason = htmlspecialchars(trim($_POST['reason']));

    // Check if the fields are not empty
    if (!empty($unavailableDate) && !empty($reason)) {
        try {
            // Use the $conn variable from db.php
            if ($conn) {
                // Prepare the SQL statement
                $stmt = $conn->prepare("INSERT INTO unavailable (unavailable, reason) VALUES (:unavailable, :reason)");
                $stmt->bindParam(':unavailable', $unavailableDate); // Use the date
                $stmt->bindParam(':reason', $reason);

                // Execute the query
                if ($stmt->execute()) {
                    header("Location: ../../web/api/unavailable.php?message=Unavailable status added successfully");
                } else {
                    echo "Failed to add unavailable status.";
                }
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all the fields.";
    }
}
?>
