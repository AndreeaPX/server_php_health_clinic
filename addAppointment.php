<?php

include 'connection.php';

$email = $_POST['email'];
$dateFromApp = $_POST['date'];
$dateAppointment = date('Y-m-d', strtotime($dateFromApp));
$timeAppointment = $_POST['time'];
$details = $_POST['details'];
$id_clinic = $_POST['id_clinic'];
$id_doctor = $_POST['id_doctor'];

function getId($connection, $email) {
    $command = $connection->prepare("SELECT id from user WHERE email=? limit 1");
    $command->bind_param('s', $email);
    $command->execute();
    $res = $command->get_result();
    $elm = $res->fetch_row();
    $id = $elm[0];
    return $id;
}

$id_user = getId($connection, $email);

$appointment_count = 0;
$appointments_number=0;
$appointment_time=0;

$check_query = $connection->prepare("SELECT COUNT(*) FROM appointment WHERE id_user = ? AND date = ?");
$check_query->bind_param('is', $id_user, $dateAppointment);
$check_query->execute();
$check_result = $check_query->get_result();
if ($check_result) {
    $appointment_count = $check_result->fetch_row()[0];
}

$query_max = $connection->prepare("SELECT COUNT(*) FROM appointment WHERE id_doctor = ? AND id_clinic = ? and date = ?");
$query_max->bind_param('iis',$id_doctor,$id_clinic,$dateAppointment);
$query_max->execute();
$max_result = $query_max->get_result();
if($max_result){
    $appointments_number = $max_result->fetch_row()[0];
}

$query_time = $connection->prepare("SELECT COUNT(*) FROM appointment WHERE id_doctor = ? AND id_clinic = ? and date = ? and time = ?");
$query_time->bind_param('iiss',$id_doctor,$id_clinic,$dateAppointment, $timeAppointment);
$query_time->execute();
$time_result = $query_time->get_result();
if($time_result){
    $appointment_time = $time_result->fetch_row()[0];
}

if ($appointment_count > 0) {
    $response = array('message' => 'You can not have more than one appointment in a day.');
    echo json_encode($response);
}
else if($appointments_number == 5){
    $response = array('message' => 'The maximum number of appointments for this doctor has been reached.');
    echo json_encode($response);
    
} else if($appointment_time > 0){
    $response = array('message'=>'This hour is not available,');
    echo json_encode($response);
} else {
    $insert_query = $connection->prepare("INSERT INTO appointment (date, time, details, id_clinic, id_user, id_doctor) VALUES (?, ?, ?, ?, ?, ?)");
    $insert_query->bind_param('ssssii', $dateAppointment, $timeAppointment, $details, $id_clinic, $id_user, $id_doctor);
    $insert_result = $insert_query->execute();

    if ($insert_result) {
        $response = array('message' => 'Appointment registered successfully.');
        echo json_encode($response);
    } else {
        $response = array('message' => 'Error registering appointment.');
        echo json_encode($response);
    }
}

$check_query->close();
$query_max->close();
$query_time->close();
$connection->close();
?>