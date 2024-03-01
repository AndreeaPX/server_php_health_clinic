<?php
include "connection.php";
$email = $_POST['email'];
$password = $_POST['password'];



$command = $connection->prepare("SELECT password from user WHERE email=? limit 1");
$command->bind_param('s',$email);
$command->execute();
$res = $command->get_result();
$elm = $res->fetch_row();
$hash = $elm[0];
if(password_verify($password,$hash))
{
    echo "password match";
}
$command->close();
$connection->close();
?>