<?php

require '../../../../db.php'; 

$stmt = $conn->prepare("SELECT system_logo, cover, welcome_image, about_us_image FROM system_settings WHERE id = 1");
$stmt->execute();
$existing_images = $stmt->fetch(PDO::FETCH_ASSOC);


$upload_dir = '../../../../assets/img/';


$system_logo = $_FILES['system-logo']['name'];
$cover = $_FILES['cover']['name'];
$system_name = $_POST['system-name'];
$system_short_name = $_POST['system-short-name'];
$welcome_content = $_POST['welcome-content'];
$about_us = $_POST['about-us'];
$welcome_image = $_FILES['welcome-image']['name'];
$about_us_image = $_FILES['about-us-image']['name'];
$email = $_POST['email'];
$contact_num = $_POST['contact-num'];
$location = $_POST['location'];


function delete_old_image($existing_image, $upload_dir) {
    if (!empty($existing_image) && file_exists($upload_dir . $existing_image)) {
        unlink($upload_dir . $existing_image); 
    }
}


if (!empty($system_logo)) {
    delete_old_image($existing_images['system_logo'], $upload_dir);
    move_uploaded_file($_FILES['system-logo']['tmp_name'], $upload_dir . $system_logo);
} else {
    $system_logo = $existing_images['system_logo'];  
}

if (!empty($cover)) {
    delete_old_image($existing_images['cover'], $upload_dir);
    move_uploaded_file($_FILES['cover']['tmp_name'], $upload_dir . $cover);
} else {
    $cover = $existing_images['cover'];
}

if (!empty($welcome_image)) {
    delete_old_image($existing_images['welcome_image'], $upload_dir);
    move_uploaded_file($_FILES['welcome-image']['tmp_name'], $upload_dir . $welcome_image);
} else {
    $welcome_image = $existing_images['welcome_image'];
}

if (!empty($about_us_image)) {
    delete_old_image($existing_images['about_us_image'], $upload_dir);
    move_uploaded_file($_FILES['about-us-image']['tmp_name'], $upload_dir . $about_us_image);
} else {
    $about_us_image = $existing_images['about_us_image'];
}

try {
    
    $sql = "UPDATE system_settings SET 
            system_logo = :system_logo,
            cover = :cover,
            system_name = :system_name,
            system_short_name = :system_short_name,
            welcome_content = :welcome_content,
            welcome_image = :welcome_image,
            about_us = :about_us,
            about_us_image = :about_us_image,
            email = :email,
            contact_num = :contact_num,
            location = :location
            WHERE id = 1"; 

    
    $stmt = $conn->prepare($sql);

    
    $stmt->bindParam(':system_logo', $system_logo);
    $stmt->bindParam(':cover', $cover);
    $stmt->bindParam(':system_name', $system_name);
    $stmt->bindParam(':system_short_name', $system_short_name);
    $stmt->bindParam(':welcome_content', $welcome_content);
    $stmt->bindParam(':welcome_image', $welcome_image);
    $stmt->bindParam(':about_us', $about_us);
    $stmt->bindParam(':about_us_image', $about_us_image);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact_num', $contact_num);
    $stmt->bindParam(':location', $location);

    
    if ($stmt->execute()) {
        header('Location: ../../web/api/settings.php');
    } else {
        echo "Error updating record.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;

?>
