<?php
session_start();
require 'mysql_connect.php';

/* Updating hotel information */

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$pricemax = $_POST['pricemax'];
$description = $_POST['description'];
$facility = $_POST['facility'];
$location = strtolower($_POST['location']);
$latitude = $_POST['latitude']; // Capture latitude from the form
$longitude = $_POST['longitude']; // Capture longitude from the form

// Create slug from hotel name
$name_slug = preg_replace('#[ -]+#', '-', strtolower($name));

// Set up directory for hotel images
$target_dir = "assets/hotel_img/" . $name_slug;
if (!file_exists($target_dir)) {
    mkdir($target_dir);
}

$img = $_FILES['file']['name'];
$target_file = $target_dir . "/" . $_FILES['file']['name'];

// Upload hotel image if file is provided
if (!empty($_FILES['file']['tmp_name'])) {
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
}

// Update hotel data in the database
if (empty($_FILES['file']['tmp_name'])) {
    // If no new image is uploaded
    $sql = "UPDATE hotel SET 
                name='$name', 
                price='$price', 
                pricemax='$pricemax', 
                description='$description', 
                facility='$facility', 
                location='$location', 
                latitude='$latitude', 
                longitude='$longitude' 
            WHERE id=$id";
} else {
    // If a new image is uploaded
    $sql = "UPDATE hotel SET 
                name='$name', 
                price='$price', 
                pricemax='$pricemax', 
                description='$description', 
                facility='$facility', 
                location='$location', 
                latitude='$latitude', 
                longitude='$longitude', 
                img='$img' 
            WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    header("Location: all-hotel.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
