<?php
include "connection.php";
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$pass = password_hash($password,PASSWORD_DEFAULT);


$command = $connection->prepare("SELECT phone from user WHERE email=? limit 1");
$command->bind_param('s',$email);
$command->execute();
$res = $command->get_result();
$elm = $res->fetch_row();
$db_element = $elm[0];
if($phone == $db_element)
{
    echo "correct";
    $query = $connection->prepare("UPDATE user SET password = ? WHERE email = ? and phone = ?");
    $query->bind_param("sss",$pass,$email,$phone);
    $query->execute();
    $query->close();

}else{
    echo "The email does not match the phone number so the password can not be changed.";
}
$command->close();
$connection->close();
?>