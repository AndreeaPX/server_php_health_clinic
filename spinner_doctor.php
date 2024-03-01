<?php

include "connection.php";
$sql = "SELECT * FROM doctor";
if(!$connection->query($sql)){
    echo "Error in connecting to dataBase";
}
else {
    $result = $connection -> query($sql);
    if($result->num_rows >0){
        $result_array['doctor'] = array();
        while($row = $result->fetch_array()){
            array_push($result_array['doctor'], array(
                'id'=>$row['id'],
                'lastName'=>$row['lastName'],
                'firstName'=>$row['firstName'],
                'id_specialization' =>$row['id_specialization']
            ));
        }
        echo json_encode($result_array);
    }
}
?>