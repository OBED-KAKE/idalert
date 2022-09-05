<?php
  $endPoint = 'https://api.mnotify.com/api/sms/quick';
  $apiKey = '0eHNm9PvaACqrbi3NpUqauH7DUukByLBMsp9CeFMPidht';
  $url = $endPoint . '?key=' . $apiKey;
  $data = [
     'recipient' => ['0546747672',$number],
     'sender' => 'ID ALERT',
     'message' => 'Hi, '.$firstName.'! You will be notified when your ID CARD is about to expire',
     'is_schedule' => 'false',
     'schedule_date' => ''
  ];

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
  echo var_export($result);
  curl_close($ch);
?>