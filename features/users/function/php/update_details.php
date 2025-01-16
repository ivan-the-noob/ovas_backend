<?php
session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Email not set';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['change_name'];
    $new_address = $_POST['change_address'];
    $new_contact_num = $_POST['change_number']; 

    require '../../../../db.php';

    try {
        $sql = "UPDATE users SET name = :name, address = :address, contact_num = :contact_num WHERE email = :email"; // Changed to contact_num
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $new_name);
        $stmt->bindParam(':address', $new_address);
        $stmt->bindParam(':contact_num', $new_contact_num);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            header('Location: ../../web/api/settings.php');
            exit();
        } else {
            echo "Error updating details.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
