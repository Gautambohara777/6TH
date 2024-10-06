<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <style>
    /* General reset for padding and margins */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body Styling */
    body {
       height: 100vh;
      background-repeat: no-repeat;
      background-color: #f7f9fd;
      font-family: 'Nunito', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      
     
    }

    /* Centered card container */
    .card-container {
      background-color: white;
      padding: 30px 25px;
      border-radius: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
      width: 100%;
      max-width: 295px; /* Set a max-width to prevent it from stretching too much */
      text-align: center;
      background-color: #fff;
      
  /* just in case there no content*/
  padding: 20px 25px 30px;
  margin: 0 auto 25px;
  margin-top: 50px;
  /* shadows and rounded borders */
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0 15px 38px rgb(25 25 48 / 10%);
  -webkit-box-shadow: 0 15px 38px rgb(25 25 48 / 10%);
  box-shadow: 0 15px 38px rgb(25 25 48 / 10%);
    }

    /* Input fields styling */
    input[type=text], input[type=password] {
      direction: ltr;
       width: 100%;
      padding: 12px 15px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    /* Submit button styling */
    input[type=submit] {
      width: 100%;
      background-color: #664bc4; 
      color: white;
      padding: 14px 20px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    /* Hover effect for the button */
    input[type=submit]:hover {
      background-color: #4A47A1; /* Slightly darker on hover */
    }

    /* Registration link styling */
    a.regbtn {
      display: block;
      margin-top: 20px;
      text-decoration: none;
      color: #5A55A3;
      font-weight: bold;
    }

    a.regbtn:hover {
      text-decoration: underline;
    }

    /* Error message styling */
    .alert {
      color: red;
      font-size: 14px;
    }
  </style>
</head>

<body>

<div class="card-container">
  <!-- Displaying session alert -->
  <div>
    <?php if (isset($_SESSION['alert'])) {
      echo $_SESSION['alert'];
      $_SESSION['alert'] = ""; // Clear the alert after displaying
    } ?>
  </div>

  <!-- Form Title -->
  <img id="profile-img" class="text-center" src="assets/image/logo.png" width="250px" style="margin:0 auto;">

  <!-- Registration Form -->
  <form action="registernow.php" method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Username" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Password" required>

    <input type="submit" value="Submit">
  </form>

  <!-- Link to Login page -->
  <a class="regbtn" href="login.php">Login</a>
</div>

</body>
</html>
