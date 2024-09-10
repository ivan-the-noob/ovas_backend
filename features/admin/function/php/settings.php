<?php
require '../../../../db.php'; // Connect to the database

// Fetch the current settings from the database
$stmt = $conn->prepare("SELECT * FROM system_settings WHERE id = 1"); // Adjust the `id` as needed
$stmt->execute();
$settings = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the settings as an associative array

// Check if the settings exist
if ($settings) {
    $system_logo = $settings['system_logo'];
    $cover = $settings['cover'];
    $system_name = $settings['system_name'];
    $system_short_name = $settings['system_short_name'];
    $welcome_content = $settings['welcome_content'];
    $welcome_image = $settings['welcome_image'];
    $about_us = $settings['about_us'];
    $about_us_image = $settings['about_us_image'];
    $email = $settings['email'];
    $contact_num = $settings['contact_num'];
    $location = $settings['location'];
} else {
    echo "No settings found!";
}
?>