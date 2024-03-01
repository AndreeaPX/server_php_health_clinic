<?php

include "connection.php";
$email = $_POST['email'];
$id = $_POST['id'];

function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}


$id_user = getId($connection, $email);
$sql = "DELETE FROM appointment WHERE id_user = '".$id_user."' AND id = '".$id."'";
mysqli_query($connection,$sql);
mysqli_close($connection);
?>