<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Maps </title>
    <style>
        
        /* Set the size of the map */
        #map {
            position: absolute;
            top: 10px; /* Adjust to match your header height */
            right: 0;
            height: 50vh; /* Full height */
            width: 50%;   /* Full width */
           
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        function initMap() {
            // Create a map centered at a specific location
            const location = { lat: 27.700001, lng: 85.333336 }; // Change this to your desired location
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: location,
            });

            // Add a marker at the location
            // const marker = new google.maps.Marker({
            //     position: location,
            //     map: map,
            //     title: "Hello World!", // Title of the marker
            // });
        }
    </script>

    <!-- Include the Google Maps JavaScript API -->
    <script async defer
        src="https://maps.gomaps.pro/maps/api/js?key=AlzaSyTPMWUgyP4IvsxfBbk0JEIkp8xAFrIzG6B&callback=initMap">
    </script>
</body>
</html>




