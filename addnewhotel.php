<?php
session_start();
require 'mysql_connect.php';

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$facility = $_POST['facility'];
$location = strtolower($_POST['location']);
$latitude = $_POST['latitude']; // Capture latitude from the form
$longitude = $_POST['longitude']; // Capture longitude from the form

// Create slug from hotel name
$delimiter = '-';
$name_slug = preg_replace('#[ -]+#', '-', strtolower($name));

// Set up directory for hotel images
$target_dir = "assets/hotel_img/".$name_slug;
if (!file_exists($target_dir)) {
    mkdir($target_dir);
}

$img = $_FILES['file']['name'];
$target_file = $target_dir."/".$_FILES['file']['name'];

// Upload hotel image
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

// Insert hotel data into the database
$sql = "INSERT INTO hotel (name, price, description, facility, location, latitude, longitude, img)
VALUES ('$name', '$price', '$description', '$facility', '$location', '$latitude', '$longitude', '$img')";

if ($conn->query($sql) === TRUE) {
    header("Location: all-hotel.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
