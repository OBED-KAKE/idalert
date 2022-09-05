<?php
    require 'connect.php';
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
        print_r($postdata);
        //Extract the data
        $getdata = json_decode($postdata);

        //Sanitize.k
         //Sanitize.       
         $firstname = mysqli_real_escape_string($con, trim($getdata->firstName));
         $lastname = mysqli_real_escape_string($con, trim($getdata->lastName));
         $othername = mysqli_real_escape_string($con, trim($getdata->otherName));
         $idtype = mysqli_real_escape_string($con, trim($getdata->idType));
         $idnumber = mysqli_real_escape_string($con, trim($getdata->idNumber));
         $dateIssued = mysqli_real_escape_string($con, trim($getdata->dateOfIssue));
       echo  $expirydate = mysqli_real_escape_string($con, trim($getdata->expiryDate));
         $number = mysqli_real_escape_string($con, trim($getdata->number));
         $email = mysqli_real_escape_string($con, trim($getdata->email));
       echo $firstname;
       echo $number;


       //Message
       if($expirydate )

        $endPoint = 'https://api.mnotify.com/api/sms/quick';
        $apiKey = '0eHNm9PvaACqrbi3NpUqauH7DUukByLBMsp9CeFMPidht';
        $url = $endPoint . '?key=' . $apiKey;
        $data = [
          'recipient' => ['0546747672',$number],
          'sender' => 'NHIS ALERT',
          'message' => 'Hi, '.$firstname.'! Your',
          'is_schedule' => 'false',
          'schedule_date' => ''
        ];
        print_r ($data);
        $ch = curl_init();
        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
      // $result = json_decode($result, TRUE);
       // echo var_export($result);
       echo json_encode($result);
        curl_close($ch);
       
        $sql ="INSERT INTO `customers` (`FIRST_NAME`,`SURNAME`,`OTHER_NAME`,`ID_TYPE`,`ID_NUMBER`,`DATE_OF_ISSUE`,`EXPIRY_DATE`,`TELEPHONE`,`EMAIL`)
        VALUES ('{$firstname}','{$lastname}','{$othername}','{$idtype}','{$idnumber}','{$dateIssued}','{$expirydate}','{$number}','{$email}')";
    
        $result = mysqli_query($con,$sql);
       /*  $query_2 = "UPDATE `voters_table` SET `STATUS`= '$voter_status', `YET_TO_VOTE`='$portfolio_yet_to_vote' WHERE `ID`={$voter_id}";
      $result_2 = mysqli_query($con,$query_2); */
echo($sql);
    if($result)
    {
      
      http_response_code(204);
    }
    else{
      return  http_response_code(422);
    }
}
?>