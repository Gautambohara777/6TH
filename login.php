<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Bootstrap and CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css"/>
    
   
    </style>

    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="card card-container">
        <div class="text-center">
            <!-- logo -->
            <img id="profile-img" class="text-center" src="assets/image/logo.png" width="250px" style="margin:0 auto;">
        </div>
        <br>

        <!-- Checking if user has logged out -->
        <?php if (isset($_GET['logout']) && $_GET['logout'] == "true") { 
            $_SESSION['is_logged_in'] = 'false'; 
            echo '<script>window.location = "login.php";</script>'; 
        } ?>

        <!-- Checking if the user is logged in -->
        <?php if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != "true") { ?>

        <!-- Displaying error messages -->
        <div class="result">
            <?php
            if (isset($_GET['empty'])){
                echo '<div class="alert alert-danger">Enter Username or Password</div>';
            } elseif (isset($_GET['loginE'])){
                echo '<div class="alert alert-danger">Username or Password Don\'t Match</div>';
            } elseif (isset($_SESSION['alert'])) {
                echo '<div class="alert alert-danger">'.$_SESSION['alert'].'</div>';
            }
            ?>
        </div>

        <!-- Login form -->
        <form class="form-signin" action="login_check.php" method="POST">
            <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="username" class="form-control" placeholder="Username or Email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">LOGIN</button>
        </form>

        <!-- Registration link -->
        <a class="regbtn" href="register.php">Register</a>

        <?php } else { 
            echo '<script>window.location = "home.php";</script>'; 
        } ?>
    </div>
</div>

</body>
</html>
