<?php
include_once "db.php";
session_start();
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $userQuery = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($connection, $userQuery);
    $user = mysqli_fetch_assoc($result);
}
// else{
//     header('Location:login.php');
// }
include_once "includes/header.php";
include_once "includes/sidebar.php";


if (isset($_GET['room_mang'])){
    include_once "room_mang.php";
}
elseif (isset($_GET['dashboard'])){
    include_once "dashboard.php";
}
elseif (isset($_GET['reservation'])){
    include_once "reservation.php";
}
else{
    include_once "room_mang.php";
}

include_once "includes/footer.php";