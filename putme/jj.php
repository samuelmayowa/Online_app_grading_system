<?php
include 'functions.php';

$stdID = user_data($_SESSION['user'], $con);
        
        function genpin($con){
            $create = rand(1000000000, 9999999999);
            $getpin = pincheck($create, $con);
            if(!empty($getpin)){
                $create = genpin($con);
            } 
            return $create;
        }function genserialNo($con){
            $serialNo = 'ESCOHSTI-'.rand(10000, 999999);
            $getserial = serialcheck($serialNo, $con);
            if(!empty($getserial)){
                $serialNo = genserialNo($con);
            } 
            return $serialNo;
        }
        
        $n = 0;
        
        while($n < 990){
            $pin = genpin($con);
            $serialNo = genserialNo($con);
            $count = 0;
            $status = 'successful';
            $success= savepinSerialNo($pin,$serialNo,$count,$status,$con);
            $n = $n + 1;
            
            echo $success.' '.$serialNo.' '.$pin.'<br>';
        }
        
       
    if($success){
        $msg=$success;
        echo "<script> alert('$success');</script>";
    }
  ?>



