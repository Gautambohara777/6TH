<?php include 'header.php' ?>
<?php include 'geo.php' ?>
<!DOCTYPE html>
<html>
<body>

<h2>Find Nearby Hotels</h2>

<!-- Form to take latitude and longitude input from the user -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  Latitude: <input type="text" name="latitude" required><br><br>
  Longitude: <input type="text" name="longitude" required><br><br>
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get latitude and longitude from user input
    $user_latitude = $_POST['latitude'];
    $user_longitude = $_POST['longitude'];

    // Validate the input
    if (!is_numeric($user_latitude) || !is_numeric($user_longitude)) {
        echo "Invalid latitude or longitude. Please enter valid numeric values.";
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select hotel data and calculate distance based on user input
    $sql = "SELECT id, name, price, location, img, latitude, longitude, 
            (6371 * acos(cos(radians($user_latitude)) * cos(radians(latitude)) 
            * cos(radians(longitude) - radians($user_longitude)) 
            + sin(radians($user_latitude)) * sin(radians(latitude)))) AS distance 
            FROM hotel 
            ORDER BY distance 
            LIMIT 0, 20;";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br> id: ". $row["id"]. " - Name: ". $row["name"]. 
                 " - Location: ".$row['location']." - Price: ".$row['price'].
                 " - Distance: ".$row['distance']."<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
}
?>

</body>
</html>
