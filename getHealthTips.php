<?php
    require 'connect.php';
    error_reporting(E_ERROR);
    $health = [];

    $sql = "SELECT * FROM health_tips";
    
    if($result = mysqli_query($con,$sql))
    {
        $cr = 0;
        while($row = mysqli_fetch_assoc($result)){
            $health[$cr]['id'] = $row['tip_id'];
            $health[$cr]['message'] = $row['tip_message'];
            $cr++;
        }
       // print_r($health);
        echo json_encode($health);
    }
    else{
       return http_response_code(404);
    }
?>
