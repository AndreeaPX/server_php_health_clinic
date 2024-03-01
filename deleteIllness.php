<?php

include "connection.php";
$email = $_POST['email'];
$illness = $_POST['illness'];

function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

function getIdIllness($connection,$illness){
    $command = $connection->prepare("SELECT id_illness from illness WHERE text=? limit 1");
    $command->bind_param('s',$illness);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

$id = getId($connection, $email);
$id_illness = getIdIllness($connection,$illness);
$sql = "DELETE FROM r_illnesses WHERE id_user = '".$id."' AND id_illness = '".$id_illness."'";
echo $id;
echo $id_illness;
mysqli_query($connection,$sql);
mysqli_close($connection);
?>