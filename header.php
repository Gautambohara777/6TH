<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>FMH</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/style.css"> <!-- External stylesheet -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> 
  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 

  <!-- External fonts and stylesheets -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <!-- jQuery Datepicker initialization -->
  <script>
    $(function() {
      $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true
      });
    });
  </script>
</head>
<body>

<header>
  

  <?php 
    // Initialize session variable if not set
    if (!isset($_SESSION['is_logged_in'])) { 
      $_SESSION['is_logged_in'] = "0";
    } 
    
  ?>

  <!-- User authentication and navigation -->
  <div class="header-buttons">
    <?php if ($_SESSION['is_logged_in'] == "true") { ?>

      <?php if ($_SESSION['userid'] == '1') { ?>
        <!-- Admin Panel link for admin users -->
        <div id="adminpanel">
          <a href="all-hotel.php">Admin Panel</a>
        </div>
      <?php } ?>

        <!-- Admin Panel link for users with user ID greater than 1000 -->
      <?php if (isset($_SESSION['userid']) && $_SESSION['userid'] > 1000) { ?>
  
    <div id="adminpanel">
      <a href="index.php">DASHBORD </a>
    </div>
    <?php } ?>


      <!-- Logout link for logged-in users -->
      <div id="login">
        <a href="login.php?logout=true">Logout</a>
      </div>

    <?php } else { ?>
      <!-- Register and Login links for guests -->
      <div id="register">
        <a href="register.php">Register</a>
      </div>
      <div id="login">
        <a href="login.php">Login</a>
      </div>
    <?php } ?>

    <!-- Home link for all users -->
    <div id="login" style="float:right;">
      <a href="home.php">Home</a>
    </div>
  </div>
</header>
<!-- Logo section -->
<div class="logo">
    <a href="home.php"><img src="assets/image/logo.png" alt="Logo" class="logo"></a> 
  </div>
<!-- Search form section -->
<div class="search-form-div">
  <h2 style="font-weight: bold;">SEARCH HOTELS</h2>
</div>
<div class="search-form-div">
  <form class="serach-form" action='search.php' method='post'>
    <input type="text" name="city" placeholder="City name"> 
    <input type="text" class='datepicker' name="checkin" placeholder="Check-in">
    <input type="text" class='datepicker' name="checkout" placeholder="Check-out">
    <input type="text" name="budgetmax" placeholder="Budget max">
    <input type="submit" value="Submit" style="background: #120c4e; height: 30px; color: white;"> 
  </form> 
</div>

</body>
</html>
