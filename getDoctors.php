<?php

include "connection.php";
$sql = "SELECT * FROM r_doctor";
if(!$connection->query($sql)){
    echo "Error in connecting to dataBase";
}
else {
    $result = $connection -> query($sql);
    if($result->num_rows >0){
        $result_array['r_doctor'] = array();
        while($row = $result->fetch_array()){
            array_push($result_array['r_doctor'], array(
                'id_doctor'=>$row['id_doctor'],
                'id_clinic'=>$row['id_clinic']
            ));
        }
        echo json_encode($result_array);
    }
}
?>