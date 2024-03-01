<?php
include "connection.php";
$email = $_GET['email'];
$sql = "SELECT r_medication.id_medication, drugs, startingDate, dosage, times, dates 
from r_medication JOIN medication ON r_medication.id_medication = medication.id_medication
 WHERE id_user = (SELECT id FROM user WHERE email = '$email')";
$result = $connection->query($sql);
while($file = $result->fetch_array()){
    $array_res[] = array_map('utf8_encode',$file);
}
echo json_encode($array_res);
$result->close();
?>