<?php

$hostName = 'localhost';
$email = 'root'; 
$dataBase = 'database';
$password = '';

$connection = new mysqli($hostName,$email,$password,$dataBase);
if($connection->connect_errno){
    echo 'We have a connection problem, please try again later';
} 

?>