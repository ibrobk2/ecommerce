<?php
session_start();

session_destroy();

header("location: user.php");

include "server.php";
 
$username = $_SESSION['logged'];

$sign = "UPDATE users WHERE username='$username' SET status = 'offline'";
$on = mysqli_query($conn, $sign);
?>