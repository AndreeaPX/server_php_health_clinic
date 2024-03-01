<?php

include "connection.php";
$email = $_POST['email'];

function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

$id = getId($connection, $email);
$sql = "DELETE FROM user WHERE id = '".$id."'";
mysqli_query($connection,$sql);
mysqli_close($connection);
?>