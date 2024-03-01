<?php

include "connection.php";
$email = $_POST['email'];
$medication_id = $_POST['id_medication'];

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
$sql = "DELETE FROM r_medication WHERE id_user = '".$id."' AND id_medication = '".$medication_id."'";
mysqli_query($connection,$sql);
mysqli_close($connection);
$connection->close();

?>