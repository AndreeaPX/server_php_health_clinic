<?php
include "connection.php";
$email = $_POST['email'];
$text = $_POST['text'];
$startingDate = $_POST['startingDate'];


function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

function getIllnessID($connection, $text){
    $command = $connection->prepare("SELECT id_illness from illness WHERE text=? limit 1");
    $command->bind_param('s',$text);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id_illness = $elm[0];
    return $id_illness;
}

$id_user = getId($connection, $email);
$id_illness = getIllnessID($connection,$text);
try{
    $sql = "INSERT INTO r_illnesses (id_user, id_illness, startingDate) VALUES ('".$id_user."','".$id_illness."','".$startingDate."')";
    mysqli_query($connection,$sql);
    echo "Done!";
    }
    catch(Exception $e){
        if ($e->getCode() === 1062)
        {
            echo "The data you are trying to add is already saved, please try again."; 
        }
        else{
            echo "Success!";
        }
    }
?>