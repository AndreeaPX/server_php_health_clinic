<?php

include 'connection.php';
$email = $_POST['email'];
$photo = $_POST['photo'];
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
$path = "profile_image/$user_id.jpeg";
$finalPath = "http://172.20.10.3/Inregistrare/".$path;
$sql = "UPDATE user SET picture='$finalPath' WHERE id = '$user_id'";
if(mysqli_query($connection, $sql)){
    if(file_put_contents($path, base64_decode($photo))){
        $result = array();
        $result['success'] = "1";
        $result['message'] = "success";
        echo json_encode($result);
        mysqli_close($connection);
    }
}

?>