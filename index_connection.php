<?php

include 'db.php';

$sql = "SELECT * FROM system_settings WHERE id = 1"; 
$stmt = $conn->prepare($sql);
$stmt->execute();
$settings = [];

if ($stmt->rowCount() > 0) {
    $settings = $stmt->fetch(PDO::FETCH_ASSOC); 
    $logo_path = $settings['system_logo']; 
    $welcome_content = $settings['welcome_content']; 
    $about_us = $settings ['about_us'];
    $contact_num = $settings ['contact_num'];
    $email = $settings ['email'];
    $location = $settings ['location'];
   
} 

?>