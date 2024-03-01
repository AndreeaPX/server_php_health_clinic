<?php
include "connection.php";
$email = $_GET['email'];
$sql = "SELECT * FROM rating WHERE id_appointment in (SELECT id FROM appointment where id_user in ( SELECT id FROM user WHERE email = '$email'))";
$result = $connection->query($sql);
while($file = $result->fetch_array()){
    $array_res[] = array_map('utf8_encode',$file);
}
echo json_encode($array_res);
$result->close();
?>