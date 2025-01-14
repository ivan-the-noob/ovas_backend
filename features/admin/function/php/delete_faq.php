<?php
include('../../../../db.php'); 

try {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $faq_id = $_GET['id'];

        if ($conn) { 
            $query = "DELETE FROM faqs WHERE id = :faq_id";
            $stmt = $conn->prepare($query); 

            $stmt->bindParam(':faq_id', $faq_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: ../../web/api/faqs.php?message=FAQ deleted successfully");
                exit();
            } else {
                header("Location: ../../web/api/faqs.php?message=Error deleting FAQ");
                exit();
            }
        } else {
            header("Location: ../../web/api/faqs.php?message=Database connection error");
            exit();
        }
    } else {
        header("Location: ../../web/api/faqs.php?message=Invalid FAQ ID");
        exit();
    }
} catch (PDOException $e) {
    header("Location: ../../web/api/faqs.php?message=Database error: " . $e->getMessage());
    exit();
}
?>
