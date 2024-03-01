<?php
include "connection.php";
$email = $_GET['email'];
$sql = "SELECT id_illness, text, category, IsRare, Risk FROM illness WHERE id_illness 
in (SELECT id_illness FROM r_illnesses where id_user = (SELECT id FROM user where email = '$email'))";
$result = $connection->query($sql);
while($file = $result->fetch_array()){
    $illnesses[] = array_map('utf8_encode',$file);
}
echo json_encode($illnesses);
$result->close();
?>