<?php

include "connection.php";
$email = $_GET['email'];
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $connection->query($sql);
while($file = $result->fetch_array()){
    $user[] = array_map('utf8_encode',$file);
}
echo json_encode($user);
$result->close();
$connection->close();
?>