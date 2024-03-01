<?php
include 'connection.php';
$email = $_POST['email'];
$title = $_POST['title'];
$body = $_POST['body'];
$dateFromApp = $_POST['date'];
$dateUpload = date('Y-m-d', strtotime($dateFromApp));

function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

$id_user = getId($connection,$email);

$sql = "INSERT INTO document (title, body, upload_date, user_id) VALUES (?, ?, ?, ?)";
$statement = $connection->prepare($sql);
$statement->bind_param('sssi', $title, $body, $dateUpload, $id_user);
$statement->execute();
$statement->close();
$connection->close();
?>