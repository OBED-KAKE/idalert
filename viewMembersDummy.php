<?php
    require 'connectDummy.php';
    error_reporting(E_ERROR);
    $currentDate = date('Y-m-d');
        $members = [];

        $sql = "SELECT * FROM membership ORDER BY CARD_STATUS DESC";
    
        if($result = mysqli_query($con,$sql))
        {
            $cr = 0;
            while($row = mysqli_fetch_assoc($result)){
                $members[$cr]['id'] = $row['id'];
                $members[$cr]['firstname'] = $row['FIRSTNAME'];
                $members[$cr]['lastname'] = $row['LASTNAME'];
                $members[$cr]['othername'] = $row['OTHERNAME'];
                $members[$cr]['number'] = $row['PHONE_NUMBER'];
                $members[$cr]['member_id'] = $row['MEMBERSHIP_ID'];
                $members[$cr]['date_of_issue'] = $row['DATE_OF_ISSUE'];
                $members[$cr]['last_renewed_date'] = $row['LAST_RENEWED_DATE'];
                $members[$cr]['expiry_date'] = $row['EXPIRY_DATE1'];
                $members[$cr]['card_status'] = $row['CARD_STATUS'];
                $members[$cr]['email'] = $row['EMAIL'];

                $current_date = date('Y-m-d')." ";
                $datetime1 = strtotime(date('Y-m-d', strtotime($current_date)));
                $datetime2 = strtotime(date('Y-m-d', strtotime($members[$cr]['expiry_date'])));

                $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                $days = $secs / 86400;
                $members[$cr]['days_left'] = $days;

              
                
                $cr++;
            }
           // print_r($members);
            echo json_encode($members);
        }
        else{
           return http_response_code(404);
        }
 

?>