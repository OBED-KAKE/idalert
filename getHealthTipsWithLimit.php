<?php
    require 'connect.php';
    error_reporting(E_ERROR);
    $health = [];

    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
     //   print_r($postdata);
        $getdata = json_decode($postdata);

        //Sanitize.k
         //Sanitize.       
         $offset = mysqli_real_escape_string($con, trim($getdata->param1));
         $limit = mysqli_real_escape_string($con, trim($getdata->param2));

    $row_count = mysqli_query($con,"SELECT * FROM health_tips");
    $count = mysqli_num_rows($row_count);

    $sql = "SELECT * FROM health_tips ORDER BY tip_id DESC LIMIT $limit OFFSET $offset";
    
    if($result = mysqli_query($con,$sql))
    {
        $cr = 0;
        while($row = mysqli_fetch_assoc($result)){
            $health['data'][$cr]['id'] = $row['tip_id'];
            $health['data'][$cr]['title'] = $row['tip_title'];
            $health['data'][$cr]['message'] = $row['tip_message'];
            $health['data'][$cr]['image'] = $row['tip_image'] ;
            $cr++;
        }
       // print_r($health);
       $health['total'] = $count;
        echo json_encode($health);
    }
    else{
        echo mysqli_error($con);
       return http_response_code(404);
    }
    }
?>
