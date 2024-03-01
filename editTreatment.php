<?php
include 'connection.php';
$email = $_POST['email'];
$id_medication = $_POST['id'];
$interval = $_POST['interval'];
$times = $_POST['times'];
$startingDate = $_POST['startingDate'];
$dosage = $_POST['dosage'];

function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}


$user_id = getId($connection, $email);

$sql = "UPDATE r_medication set startingDate = '".$startingDate."', dosage = '".$dosage."',times = '".$times."', dates = '".$interval."' WHERE id_user = '".$user_id."' AND id_medication = '".$id_medication."'";
mysqli_query($connection,$sql);




?>