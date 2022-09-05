<?php
if ($sql->num_rows > 0) {
    $user = $sql->fetch_assoc();
    if ($phone == $user['PHONE_NUMBER'])) {
       // echo 'password match';
        $payload = array(
            'user_id' => $user['id'],
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
    } else {
       // echo 'password unmatch';
        http_response_code(401);
        echo 'Invalid phone number';
      // echo json_encode(array('message' => 'Invaid username/password', 'code'=>0));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Invalid Card ID'));
}
?>