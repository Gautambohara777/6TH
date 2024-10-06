<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Maps </title>
   
</head>
<body>
    <!-- Include the Google Maps JavaScript API -->
    <script async defer
        src="https://maps.gomaps.pro/maps/api/js?key=AlzaSyTPMWUgyP4IvsxfBbk0JEIkp8xAFrIzG6B&callback=initMap">
    </script>
</body>
</html>




<?php
// Google Maps API Key
$GOOGLE_API_KEY = 'AlzaSyTPMWUgyP4IvsxfBbk0JEIkp8xAFrIzG6B';

$latitude = 27.700001; // Default latitude (can be Kathmandu)
$longitude = 85.333336; // Default longitude (can be Kathmandu)
$formatted_address = 'Kathmandu, Nepal'; // Default location

if(isset($_POST['submit'])){
    // Address from which the latitude and longitude will be retrieved
    $address = $_POST['address'];

    // Formatted address
    $formatted_address = str_replace(' ', '+', $address);

    // Get geo data from Google Maps API by address
    $geocodeFromAddr = file_get_contents("https://maps.gomaps.pro/maps/api/geocode/json?address={$formatted_address}&key={$GOOGLE_API_KEY}");

    // Decode JSON data returned by API
    $apiResponse = json_decode($geocodeFromAddr);

    if(!empty($apiResponse->error_message)){
        $api_error = $apiResponse->error_message;
    }else{
        // Retrieve latitude and longitude from API data
        $latitude = $apiResponse->results[0]->geometry->location->lat;
        $longitude = $apiResponse->results[0]->geometry->location->lng;
        $formatted_address = $apiResponse->results[0]->formatted_address;
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheet file -->
    <!-- <link rel="stylesheet" href="assets/css/llf.css"> -->
     <style>
        body {
    font-family: Arial, sans-serif;
    background-color: whitesmoke;
    margin: 0;
    padding: 0;
}

/* Set the size of the map and position it */
#map {
    position: absolute;
    top: 220px; /* Adjust to match your header height */
    right: 0;
    height: 30vh; /* Half the viewport height */
    width: 30%;  /* Full width */
    margin-bottom: 20px; /* Space between map and form */
    border: 2px solid #ccc; /* Optional: add a border */
}
h1 {
    text-align: center;
    color: #333;
    margin-top: 20px;
}

.geo-wrapper {
    position: absolute;
    top: 480px; /* Adjust to match your header height */
    right: 0;
    width: 300px; /* Fixed width for the side panel */
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.geo-form-group {
    margin-bottom: 15px;
}

.geo-form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.geo-form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.geo-btn {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.geo-btn:hover {
    background-color: #0056b3;
}

.geo-alert {
    color: #d9534f;
    font-size: 14px;
    margin-bottom: 15px;
}

.geo-disp-data {
    margin-top: 20px;
}

.geo-disp-data p {
    margin: 0 0 10px;
    font-size: 14px;
}

.geo-disp-data b {
    font-weight: bold;
}
</style>
</head>
<body>
<div id="map"></div>

    <!-- <h1>Get Latitude and Longitude from Address</h1> -->
    <div class="geo-wrapper">
        <!-- Error message -->
         <?php if(!empty($api_error)){?>
                <div class="geo-alert geo-alert-danger"><?php echo $api_error; ?></div>
        <?php } ?>


        <!-- Address input form -->
        <form method="post">
            <div class="geo-form-group">
                <label>Address:</label>
                <input type="text" name="address" class="geo-form-control" value="" placeholder="Enter address" required>
            </div>
            <input type="submit" name="submit" class="geo-btn geo-btn-primary" value="Get Geo Data">
        </form>
        <!-- Display geo data -->
        <?php if(!empty($apiResponse)) { ?>
            <div class="geo-disp-data">
                <p>Formatted Address: <b><?php echo !empty($formatted_address)?$formatted_address:''; ?></b></p>
                <p>Latitude: <b><?php echo !empty($latitude)?$latitude: ''; ?></b></p>
                <p>Longitude: <b><?php echo !empty($longitude)?$longitude:''; ?></b></p>
            </div>
        <?php } ?>
    </div>
    <script>
        function initMap() {
            // Set map center to the location based on PHP values
            const location = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };

            // Create a map centered at the specified location
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: location,
            });

            // Add a marker at the location
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "<?php echo $formatted_address; ?>", // Title of the marker
            });
        }
    </script>
</body>
</html>
