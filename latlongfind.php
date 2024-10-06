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
    <title>Get Latitude and Longitude</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheet file -->
    <link rel="stylesheet" href="assets/css/llf.css">
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
