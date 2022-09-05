<?php
    require 'connect.php';
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
     //   print_r($postdata);
        $getdata = json_decode($postdata);

        //Sanitize.k
         //Sanitize.       
         $email = mysqli_real_escape_string($con, trim($getdata->username));
         $password = mysqli_real_escape_string($con, trim($getdata->password));
    
        $members = [];

    $sql = "SELECT * FROM users WHERE user_email = '{$email}'";
    
        if($result = mysqli_query($con,$sql))
        {
            $count = mysqli_num_rows($result);
            if($count>0){
                while($row = mysqli_fetch_array($result)){
                    $members['id'] = $row['user_id'];
                    $members['username'] = $row['username'];
                    $members['firstname'] = $row['user_firstname'];
                    $members['lastname'] = $row['user_lastname'];
                    $members['email'] = $row['user_email'];
                    $members['telephone'] = $row['user_telephone'];
                    $role= $row['role_id'];    
                    $db_user_password = $row['user_password'];   
                    
                    $sql = "SELECT * FROM `role` WHERE role_id = {$role}";
    
                    if($result = mysqli_query($con,$sql))
                    {                 
                            while($row = mysqli_fetch_array($result)){
                                $members['role'] = $row['role_name'];
                            }
                        }
                }
    
               
                if (password_verify($password, $db_user_password)) {
                    /* $_SESSION['username'] = $db_username;
                    $_SESSION['firstname'] = $db_user_firstname;
                    $_SESSION['lastname'] = $db_user_lastname;
                    $_SESSION['user_role'] = $db_user_role; */
               // print_r($members);
                echo json_encode($members);
                }else{
                    echo json_encode("Invalid password");
                    return http_response_code(400);
                }
            }else{
                return http_response_code(403);
            }
           
        }
        else{
           return http_response_code(404);
        }
 
    }
?>