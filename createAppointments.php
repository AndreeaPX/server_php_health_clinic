<?php

include "connection.php";
$email = $_GET['email'];

$sql = "SELECT 
  appointment.id,
  appointment.id_clinic, 
  appointment.id_user, 
  appointment.id_doctor, 
  appointment.date, 
  appointment.time, 
  appointment.details, 
  doctor.lastName, 
  doctor.firstName, 
  clinic.name, 
  clinic.address, 
  specialization.name AS specializationName
FROM appointment
JOIN clinic ON appointment.id_clinic = clinic.id
JOIN doctor ON appointment.id_doctor = doctor.id
JOIN specialization ON doctor.id_specialization = specialization.id
WHERE appointment.id_user IN (
  SELECT user.id FROM user WHERE user.email = '$email'
)AND CONCAT(appointment.date, ' ', appointment.time) >= NOW()";
$result = $connection->query($sql);
while($file = $result->fetch_array()){
    $array_res[] = array_map('utf8_encode',$file);
}
echo json_encode($array_res);
$result->close();
?>