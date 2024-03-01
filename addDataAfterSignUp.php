<?php
include 'connection.php';
$email = $_POST['email'];
$password = $_POST['password'];
$pass = password_hash($password,PASSWORD_DEFAULT);
$phone = $_POST['phone'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$datenew = date('Y-m-d', strtotime($birthday));
$gender = $_POST['gender'];
$occupation = $_POST['occupation'];
$city=$_POST['city'];

function verifyPhone($connection,$phone){
    $verify ="SELECT * FROM user where phone='".$phone."'";
    $result = mysqli_query($connection,$verify);
    $no_rows=mysqli_num_rows($result);
    if($no_rows >=1){
        return 0;
    }
    else return 1;
}

if (verifyPhone($connection,$phone) == 0 ){
    echo "error";
}else{
    $sql = "INSERT INTO user (email, password, firstName, lastName, phone, address, gender, birthday, occupation, city) 
    VALUES ('".$email."','".$pass."','".$firstName."','".$lastName."','".$phone."','".$address."','".$gender."','".$datenew."','".$occupation."','".$city."')";
    mysqli_query($connection,$sql);

}
mysqli_close($connection);
?>