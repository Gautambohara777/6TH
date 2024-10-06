<?php include 'header.php'; ?>
<?php include 'mysql_connect.php'; ?>

<!DOCTYPE html>
<html>
<body>

<h2>Find Nearby Hotels</h2>

<!-- Form to take latitude and longitude input from the user -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  Latitude: <input type="text" name="latitude" required><br><br>
  Longitude: <input type="text" name="longitude" required><br><br>
  <input type="submit" value="Find Hotels">
</form>

<div style="width:80%;background:whitesmoke;height:auto;padding:10px 300px;">
    <div class="hotels-list">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get latitude and longitude from user input
    $user_latitude = $_POST['latitude'];
    $user_longitude = $_POST['longitude'];

    // Validate the input
    if (!is_numeric($user_latitude) || !is_numeric($user_longitude)) {
        echo "<h3 style='color:red;'>Invalid latitude or longitude. Please enter valid numeric values.</h3>";
        exit();
    }

    // SQL query to select hotel data and calculate distance based on user input
    $sql = "SELECT id, name, price, location, img, latitude, longitude, 
            (6371 * acos(cos(radians($user_latitude)) * cos(radians(latitude)) 
            * cos(radians(longitude) - radians($user_longitude)) 
            + sin(radians($user_latitude)) * sin(radians(latitude)))) AS distance 
            FROM hotel 
            HAVING distance < 50 -- Find hotels within 50 km radius
            ORDER BY distance ASC 
            LIMIT 0, 20;";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of each row (nearby hotels)
        while($row = $result->fetch_assoc()) {
            $name_slug = preg_replace('#[ -]+#', '-', strtolower($row['name']));
            ?>

            <div class="hotel-list-item" style="text-align: center;overflow: hidden;height:300px;width:300px;">
                <a href="hotel.php?id=<?php echo $row['id']; ?>">

                    <div>
                        <img src="assets/hotel_img/<?php echo $name_slug; ?>/<?php echo $row['img'];?>" style="height:200px;"/>
                    </div>
                    <div class="hotel-list-item-details" style="height:50px;">
                        <span>Hotel Name: <?php echo $row['name']; ?></span><br/>
                        <span>Price: $<?php echo $row['price']; ?></span><br/>
                        <span>Distance: <?php echo round($row['distance'], 2); ?> km</span>
                    </div>
                </a>
                <a href="hoteledit.php?id=<?php echo $row['id']; ?>" style="background-color:#bdc3c7;color:white;display:block;width:130px;float:left;padding:5px 10px;">Edit</a>
                <a href="hoteldelete.php?id=<?php echo $row['id']; ?>" style="background-color:#bdc3c7;color:white;display:block;width:130px;float:left;padding:5px 10px;">Delete</a>
            </div>

            <?php 
        }
    } else {
        echo "<h3 style='color:red;'>No nearby hotels found.</h3>";
    }

    $conn->close();
}
?>

    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
