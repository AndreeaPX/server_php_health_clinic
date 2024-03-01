<?php
include "connection.php";
$email = $_POST['email'];
$drug = $_POST['drugs'];
$startingDate = $_POST['startingDate'];
$dosage = $_POST['dosage'];
$times = $_POST['times'];
$dates = $_POST['dates'];


function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

function getMedicationId($connection, $drug){
    $command = $connection->prepare("SELECT id_medication from medication WHERE drugs=? limit 1");
    $command->bind_param('s',$drug);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

$id_user = getId($connection, $email);
$id_medication = getMedicationId($connection,$drug);
try{
    $sql = "INSERT INTO r_medication (id_user, id_medication, startingDate, dosage, times, dates) VALUES ('".$id_user."','".$id_medication."','".$startingDate."','".$dosage."','".$times."','".$dates."')";
    mysqli_query($connection,$sql);
    }catch(Exception $e){
        if ($e->getCode() === 1062)
        {
            echo "The data you are trying to add is already saved, please try again .";
        }
        else{
            echo "Success!";
        }
    }
    
?>