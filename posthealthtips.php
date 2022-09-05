<?php
    require 'connect.php';
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){

        $getdata = json_decode($postdata);

        //Sanitize.k
         //Sanitize.       
         $msg = mysqli_real_escape_string($con, trim($getdata->message));


       $sql = "INSERT INTO `health_tips`(`MESSAGE`) VALUES($msg)";
   
        $result = mysqli_query($con,$sql);
    if($result)
    {
      echo "inserted successfully";
      http_response_code(204);
    }
    else{
      return  http_response_code(422);
    }
}
?>