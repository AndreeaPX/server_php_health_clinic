<?php
include "connection.php";
$email = $_GET['email'];
$sql = "SELECT * FROM document WHERE user_id = (SELECT id FROM user WHERE email = '$email')";
$result = $connection->query($sql);

if ($result) {
    $connection->set_charset("utf8");

    $array_res = array();
    while ($row = $result->fetch_assoc()) {
        $array_res[] = $row;
    }
    $result->close();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($array_res, JSON_UNESCAPED_UNICODE);
} else {
    echo "Error: " . $connection->error;
}
$connection->close();
?>