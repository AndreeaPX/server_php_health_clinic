<?php

include "connection.php";
$sql = "SELECT * FROM illness";
if(!$connection->query($sql)){
    echo "Error in connecting to dataBase";
}
else {
    $result = $connection -> query($sql);
    if($result->num_rows >0){
        $result_array['illness'] = array();
        while($row = $result->fetch_array()){
            array_push($result_array['illness'], array(
                'id_illness'=>$row['id_illness'],
                'text'=>$row['text']
            ));
        }
        echo json_encode($result_array);
    }
}
?>