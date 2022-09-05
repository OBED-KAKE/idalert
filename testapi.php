 <?php

// echo date('Y-m-d');
/*  $url = 'http://localhost/idalert/viewMembersDummy.php';
$json = file_get_contents($url);
$details = json_decode($json, TRUE);

var_export($details);

foreach ($details as $k){
  echo $k['firstname'];
  echo $k['lastname'];
  echo $k['othername'];
  echo $k['number'];
  echo $k['member_id'];
  echo $k['date_of_issue'];
  echo $k['last_renewed_date']; 
  echo $k['expiry_date']; 
  echo $k['card_status']; 
  } */


  /* print_r($details[1]['id']);
$count = 0;
for($i = 0; $i < count($details); $i++) {
    $count++;
}
echo $count; */

 $endPoint = 'https://api.mnotify.com/api/sms/quick';
        $apiKey = '0eHNm9PvaACqrbi3NpUqauH7DUukByLBMsp9CeFMPidht';
        $url = $endPoint . '?key=' . $apiKey;
        $data = [
          'recipient' => ['0546747672'],
          'sender' => 'PROJECT2020',
          'message' => 'Hi, Your',
          'is_schedule' => 'false',
          'schedule_date' => ''
        ];
       // print_r ($data);
        $ch = curl_init();
        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
      
       $result = json_decode($result);
     
    FGGG C   echo var_export($result);
     //  echo json_encode($result);
        curl_close($ch);

        ?>
 