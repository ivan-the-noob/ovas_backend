<?php
require '../../../../db.php';  

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO patients_records 
        (ownerName, ownerAddress, mobile, home, work, viber, ownerEmail, petName, petType, sex, breed, colorMarkings, microchipNo, dob, age, serviceCategory, service, authorization, enteringComplaint, historyPhysical, date, totalPayment) 
        VALUES 
        (:ownerName, :ownerAddress, :mobile, :home, :work, :viber, :ownerEmail, :petName, :petType, :sex, :breed, :colorMarkings, :microchipNo, :dob, :age, :serviceCategory, :service, :authorization, :enteringComplaint, :historyPhysical, :date, :totalPayment)");

    $stmt->bindParam(':ownerName', $_POST['ownerName']);
    $stmt->bindParam(':ownerAddress', $_POST['ownerAddress']);
    $stmt->bindParam(':mobile', $_POST['mobile']);
    $stmt->bindParam(':home', $_POST['home']);
    $stmt->bindParam(':work', $_POST['work']);
    $stmt->bindParam(':viber', $_POST['viber']);
    $stmt->bindParam(':ownerEmail', $_POST['ownerEmail']);
    $stmt->bindParam(':petName', $_POST['petName']);
    $stmt->bindParam(':petType', $_POST['petType']);
    $stmt->bindParam(':sex', $_POST['sex']);
    $stmt->bindParam(':breed', $_POST['breed']);
    $stmt->bindParam(':colorMarkings', $_POST['colorMarkings']);
    $stmt->bindParam(':microchipNo', $_POST['microchipNo']);
    $stmt->bindParam(':dob', $_POST['dob']);
    $stmt->bindParam(':age', $_POST['age']);
    $stmt->bindParam(':serviceCategory', $_POST['serviceCategory']);
    $stmt->bindParam(':service', $_POST['service']);
    $stmt->bindParam(':authorization', $_POST['authorization']);
    $stmt->bindParam(':enteringComplaint', $_POST['enteringComplaint']);
    $stmt->bindParam(':historyPhysical', $_POST['historyPhysical']);
    $stmt->bindParam(':date', $_POST['date']);
    $stmt->bindParam(':totalPayment', $_POST['payment']); 

    if ($stmt->execute()) {
        header('Location: ../../web/api/app-records.php');
    } else {
        echo "Error: Could not execute query";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
  require '../../../../db.php';
  session_start();
    if (isset($_POST['ownerName']) && !empty($_POST['ownerName'])) 
    {
        $client_name = $_POST['ownerName']; 
        $admin_name = $_SESSION['name'];  


        $message = "{$client_name}'s record added by {$admin_name}";

        try 
        {
            $sql = "INSERT INTO app_req_notif (name, message, client_name) VALUES (:name, :message, :client_name)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $admin_name,
                ':message' => $message,
                ':client_name' => $client_name
            ]);

            echo "Notification added successfully!";
        } 
        catch (PDOException $e) 
        {
            echo "Error: " . $e->getMessage();
        }
    } 
    else 
    {
        echo "Client name is required.";
    }
}

$conn = null;
?>
