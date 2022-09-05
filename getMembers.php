<?php
    require 'connect.php';
    error_reporting(E_ERROR);
    $candidate = [];
    $currentDate = date('Y-m-d');

    $url = 'http://localhost/idalert/viewMembersDummy.php';
    $json = file_get_contents($url);
    $details = json_decode($json, TRUE);
    
    // var_export($details);
     
    foreach ($details as $k){

    
        $firstname = mysqli_real_escape_string($con, trim($k['firstname']));
        $lastname =  mysqli_real_escape_string($con, trim($k['lastname']));
        $othername = mysqli_real_escape_string($con, trim($k['othername']));
        $number =    mysqli_real_escape_string($con, trim($k['number']));
        $email =    mysqli_real_escape_string($con, trim($k['email']));
        //   $idnumber = 
        $idnumber = mysqli_real_escape_string($con, trim($k['member_id']));
        $dateIssued = mysqli_real_escape_string($con, trim($k['date_of_issue']));
        $renewedDate = mysqli_real_escape_string($con, trim($k['last_renewed_date'])); 
        $cardExpirydate = mysqli_real_escape_string($con, trim($k['expiry_date'])); 
        $status = mysqli_real_escape_string($con, trim($k['card_status'])); 
    
    
    
        $sql = "SELECT * FROM `card` WHERE card_id = '{$idnumber}'";
        $find_query = mysqli_query($con, $sql);
      echo  $count55 = mysqli_num_rows($find_query);
        
        if($count55<1){
        $query_card = "INSERT INTO  `card` (card_id, card_issued_date, card_renewed_date, card_expiry_date, card_status) ";
        $query_card .= " VALUES ('$idnumber','$dateIssued', '$renewedDate', '$cardExpirydate', '$status')";
        
        mysqli_query($con,$query_card);
    
        $query_member = "INSERT INTO  `members` (card_id, member_firstname, member_lastname, member_othername, member_telephone, member_email) ";
        $query_member .= " VALUES ('$idnumber','$firstname', '$lastname', '$othername', '$number','$email')";
        
        mysqli_query($con,$query_member);
    
        
    }
    else{
        echo "no data";
    }
    
    }
    
   // echo json_encode($candidate);
    
   
?>
