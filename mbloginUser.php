<?php
    require 'connectDummy.php';

    include_once '../vendor/autoload.php';

use \Firebase\JWT\JWT;

    include_once 'config/cors.php';
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
     //   print_r($postdata);
        $getdata = json_decode($postdata);

        //Sanitize.k
        //Sanitize.       
        $memberId = mysqli_real_escape_string($con, trim($getdata->id_number));
        $phone = mysqli_real_escape_string($con, trim($getdata->phone));
    
        $members = [];

        $sql = "SELECT * FROM membership WHERE MEMBERSHIP_ID = '{$memberId}' AND PHONE_NUMBER = '{$phone}'";

        if($result = mysqli_query($con,$sql))
        {
            $count = mysqli_num_rows($result);
            if($count>0){
                while($row = mysqli_fetch_array($result)){
                    /* $members['idnumber'] = $row['MEMBERSHIP_ID'];
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
                    $members['picture'] = $row['PICTURE'];  */

                    $payload = array(

                        'email' => $user['EMAIL'],
                        'firstname' => $user['FIRSTNAME'],
                        'lastname' => $user['LASTNAME'],
                        'dob' => $user['DOB'],
                        'gender' => $user['SEX'],
                        'renewal' => $user['LAST_RENEWAL_DATE'],
                        'expiry_date' => $user['EXPIRY_DATE'],
                        'date_of_issue' => $user['DATE_OF_ISSUE'],
                        'card_status' => $user['CARD_STATUS']
                    );
            
                    http_response_code(201);
                    echo json_encode(array('token' => $payload, 'code'=>1));
                }
                    
               // echo json_encode($members);
                //print_r($members);
               /*  if (password_verify($password, $db_user_password)) {
                    
                print_r($members);
                
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

