<?php

$connection = mysqli_connect("localhost","root","","onlinecourse","3306");

if(!$connection){
    die('Connection Failed'. mysqli_connect_error());
}

?>