<?php 

include 'connection.php';
$email = $_POST['email'];
verifyEmail($connection,$email);
function verifyEmail($connection,$email){
    $verify ="SELECT * FROM user where email='".$email."'";
    $result = mysqli_query($connection,$verify);
    $no_rows=mysqli_num_rows($result);
    if($no_rows >=1){
        echo "email exist";
    };
}

?>
