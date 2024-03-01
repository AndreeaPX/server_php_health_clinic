<?php

include "connection.php";
$sql = "SELECT * FROM medication";
if(!$connection->query($sql)){
    echo "Error in connecting to dataBase";
}
else {
    $result = $connection -> query($sql);
    if($result->num_rows >0){
        $result_array['medication'] = array();
        while($row = $result->fetch_array()){
            array_push($result_array['medication'], array(
                'id_medication'=>$row['id_medication'],
                'drugs'=>$row['drugs']
            ));
        }
        echo json_encode($result_array);
    }
}
?>