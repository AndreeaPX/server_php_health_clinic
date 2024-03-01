<?php
include 'connection.php';
$email = $_POST['email'];
$email_shared = $_POST['email_shared'];
$phone = $_POST['phone'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$datenew = date('Y-m-d', strtotime($birthday));
$gender = $_POST['gender'];
$occupation = $_POST['occupation'];
$city=$_POST['city'];

function getId($connection, $email){
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s',$email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

function verifyEmail($connection,$email_shared){
    $verify ="SELECT * FROM user where email='".$email_shared."'";
    $result = mysqli_query($connection,$verify);
    $no_rows=mysqli_num_rows($result);
    if($no_rows <= 1){
        return 0;
    }
    else return 1;
}

function verifyPhone($connection,$phone){
    $verify ="SELECT * FROM user where phone='".$phone."'";
    $result = mysqli_query($connection,$verify);
    $no_rows=mysqli_num_rows($result);
    if($no_rows <= 1){
        return 0;
    }
    else return 1;
}


$id=getId($connection,$email);
if($id){
    if(verifyEmail($connection,$email_shared)==0){
        if(verifyPhone($connection, $phone) == 0)
        {
            try{
            $sql = "UPDATE user set phone = '".$phone."', firstName = '".$firstName."', lastName = '".$lastName."', address = '".$address."', birthday = '".$datenew."', gender = '".$gender."', occupation = '".$occupation."', city = '".$city."', email = '".$email_shared."' WHERE id = '".$id."'";
            mysqli_query($connection,$sql);
            }catch(Exception $e){
                if ($e->getCode() === 1062)
                {
                    echo "1062";
                }
            }
        }}}
else{
    echo "There is a problem with your email, please try again!";
}

?>