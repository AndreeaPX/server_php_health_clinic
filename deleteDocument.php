<?php

include "connection.php";
$email = $_POST['email'];
$id_document = $_POST['id'];

function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}


$id_new = getId($connection, $email);
$sql = "DELETE FROM document WHERE user_id = '".$id_new."' AND id = '".$id_document."'";
mysqli_query($connection,$sql);
mysqli_close($connection);
?>