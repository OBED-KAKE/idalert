<?php
    require 'connect.php';
    error_reporting(E_ERROR);
    $deliveryReports = [];

    $sql = "SELECT * FROM sms_delivery_report, `card` WHERE card.card_id = sms_delivery_report.card_id";

    if($result = mysqli_query($con,$sql))
    {
        $cr = 0;
        while($row = mysqli_fetch_assoc($result)){
            $deliveryReports[$cr]['id'] = $row['report_id'];
            $deliveryReports[$cr]['card_id'] = $row['card_id'];
            $deliveryReports[$cr]['message'] = $row['report_message'];
            $deliveryReports[$cr]['report_status'] = $row['report_status'];
            $deliveryReports[$cr]['delivery_date'] = $row['report_delivery_date'];
            $deliveryReports[$cr]['card_status'] = $row['card_status'];
            $cr++;
        }
       // print_r($deliveryReports);
        echo json_encode($deliveryReports);
    }
    else{
        echo "queryy failed",mysqli_error($con);
      // return http_response_code(404);
    }
?>
