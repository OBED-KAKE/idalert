<?php
    require 'connectDummy.php';
    error_reporting(E_ERROR);
    
        $members = [];
          
            $sql = "SELECT * FROM membership";
            $find_query = mysqli_query($con, $sql);
            $count1 = mysqli_num_rows($find_query);

            $sql = "SELECT * FROM membership WHERE CARD_STATUS = 'Active'";
            $find_query = mysqli_query($con, $sql);
            $count2 = mysqli_num_rows($find_query);

            $sql = "SELECT * FROM membership WHERE CARD_STATUS = 'Expired'";
            $find_query = mysqli_query($con, $sql);
            $count3 = mysqli_num_rows($find_query);

            $sql = "SELECT * FROM membership WHERE CARD_STATUS = 'Inactive'";
            $find_query = mysqli_query($con, $sql);
            $count4 = mysqli_num_rows($find_query);
           // echo "count ", $count;
            array_push($members, ['registeredUsers'=>$count1,'activeCard'=>$count2,'expiredCard'=>$count3,'inactiveCard'=>$count4]);
           // print_r($members);
            echo json_encode($members);
        
     
 

?>