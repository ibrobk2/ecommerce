<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "commerce");

if(!$conn){
    echo "failed to connect to database".mysqli_error();
    die();
}


?>