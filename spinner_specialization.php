<?php

include "connection.php";
$sql = "SELECT * FROM specialization";
if(!$connection->query($sql)){
    echo "Error in connecting to dataBase";
}
else {
    $result = $connection -> query($sql);
    if($result->num_rows >0){
        $result_array['specialization'] = array();
        while($row = $result->fetch_array()){
            array_push($result_array['specialization'], array(
                'id'=>$row['id'],
                'name'=>$row['name']
            ));
        }
        echo json_encode($result_array);
    }
}
?>