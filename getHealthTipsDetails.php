<?php
    require 'connect.php';
    error_reporting(E_ERROR);
    $health = [];

    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
     //   print_r($postdata);
        $getTipId = json_decode($postdata);

        //Sanitize.k
         //Sanitize.       
         $tipId = mysqli_real_escape_string($con, trim($getTipId));

    $sql = "SELECT * FROM health_tips
    
    LEFT JOIN health_tips_categories 
    ON health_tips.tip_category_id = health_tips_categories.category_id
    WHERE health_tips.tip_id = $tipId";
    
    if($result = mysqli_query($con,$sql))
    {
        $cr = 0;
        while($row = mysqli_fetch_array($result)){
            $health['data']['id'] = $row['tip_id'];
            $health['data']['title'] = $row['tip_title'];
            $health['data']['message'] = $row['tip_message'];
            $health['data']['category'] = $row['category_name'] ;
            $health['data']['catId'] = $row['category_id'] ;
            $health['data']['image'] = $row['tip_image'] ;
           
        }
       // print_r($health);
        echo json_encode($health);
    }
    else{
        echo mysqli_error($con);
       return http_response_code(404);
    }
    }
?>
