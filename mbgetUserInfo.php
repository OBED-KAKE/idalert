<?php
    require 'connectDummy.php';
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
     //   print_r($postdata);
        $getdata = json_decode($postdata);

        //Sanitize.k
         //Sanitize.       
         $memberId = mysqli_real_escape_string($con, trim($getdata));
    
        $members = [];

    $sql = "SELECT * FROM membership WHERE MEMBERSHIP_ID = '{$memberId}'";
    
        if($result = mysqli_query($con,$sql))
        {
            $count = mysqli_num_rows($result);
            if($count>0){
                while($row = mysqli_fetch_array($result)){
                    $members['idnumber'] = $row['MEMBERSHIP_ID'];
                    $members['firstname'] = $row['FIRSTNAME'];
                    $members['lastname'] = $row['LASTNAME'];
                    $members['email'] = $row['EMAIL'];
                    $members['dob'] = $row['DOB'];
                    $members['phone'] = $row['PHONE_NUMBER']; 
                    $members['dateIssued'] = $row['DATE_OF_ISSUE']; 
                    $members['renewedDate'] = $row['LAST_RENEWED_DATE']; 
                    $members['expiryDate'] = $row['EXPIRY_DATE1']; 
                    $members['cardStatus'] = $row['CARD_STATUS']; 
                    $members['sex'] = $row['SEX']; 
                    $members['picture'] = $row['PICTURE']; 
                  //  $db_user_password = $row['user_password'];   
                    
                    /* $sql = "SELECT * FROM `role` WHERE role_id = {$role}";
    
                    if($result = mysqli_query($con,$sql))
                    {                 
                            while($row = mysqli_fetch_array($result)){
                                $members['role'] = $row['role_name'];
                            }
                        } */
                }
                    
                echo json_encode($members);
               /*  if (password_verify($password, $db_user_password)) {
                    
               // print_r($members);
                
                }else{
                    
                    return http_response_code(400);
                } */
            }else{
                echo json_encode("Wrong  phone number");
              //  return http_response_code(403);
            }
           
        }
        else{
            echo json_encode("Wrong input");
           
        //   return http_response_code(404);
        }
 
    }
?>