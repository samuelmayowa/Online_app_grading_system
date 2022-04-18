<?php
include_once('functions.php');
require_once('connection.php');



if(isset($_GET['user']) && isset($_GET['rrr']) && isset($_GET['orderId'])){
$sha_value =  $orderID = $apiKey = "";
$orderID = $_GET['orderId'];
$rrr = $_GET['rrr'];
$seletFromID = 1;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 5;
//$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$base_url = apiCredential($seletFromID, 'base_url');
 //$hash_value =hash("sha512",$rrr.'/'.$orderID.$ApiKey.$MerchantID);
$hash_value =hash("sha512",$rrr.$ApiKey.$MerchantID);
//$hash_value =hash("sha512",$MerchantID.$ServiceTypeID.$orderID.$amount.$ApiKey);
 $_SESSION['orderID'] = $orderID;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{$base_url}/{$MerchantID}/{$rrr}/{$hash_value}/status.reg",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "Authorization: remitaConsumerKey=$MerchantID,remitaConsumerToken=".$hash_value 
  ),
));

$response = curl_exec($curl);

curl_close($curl);
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $user_id = $_SESSION['user_id'];
    $amountPaid = $amount = $update->amount;
    $payingFor ="2021/2022 Result scratch pin";
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    
    $sql_department = "SELECT Amount FROM paymentCategories WHere payCategories='scratch_pin'";
                                                $fees = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($fees)){
                                                   
                                                    $amt = $row['Amount'];
                                                      }
$stdID = user_data($_SESSION['user'], $con);
if(!empty($statusCode ) && $statusCode == '00' && $statuspaid == 'Successful' && $amt == $amountPaid){
     $datepaid = $update->paymentDate;
    
    $response9 = updatePin($stdID,$refNNum,$statuspaid,$datepaid,$con);
    
    if($response9 == 'Invoice Updated Sucessfully'){
        $alldata = Alluser_data($_SESSION['user'], $con);
        $email = $alldata['Email'];
        $user = $alldata['Username'];
        $pin = getDoubleData($stdID,$rrr,$con)['pinHash'];
        $return['pin'] = base64_encode(base64_encode($pin));
        
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= "From: ESCOHSTI <no-reply@escohsti-edu.ng>\r\n".'X-Mailer: php';
        
        $message = "Dear $user <br> This is your pin for checking result. Don't share with anyone <br>pin: $pin";
        
       
        mail($email, 'Scratch Card Pin', $message, $headers);
        $return['msg'] = 'Payment successful and approved';
    
        echo json_encode($return);
    }else{
        //echo 'error, please contact support';
        echo $stdID.$refNNum;
    }
    
    //echo $orderID;
}elseif(!empty($statusCode ) && $statusCode == '01' && $statuspaid == 'Successful' && $amt == $amountPaid){
    
     $datepaid = $update->paymentDate;
    $response9 = updatePin($stdID,$refNNum,$statuspaid,$datepaid,$con);
    
    if($response9 == 'Invoice Updated Sucessfully'){
        $alldata = Alluser_data($_SESSION['user'], $con);
        $email = $alldata['Email'];
        $user = $alldata['Username'];
        $pin = getDoubleData($stdID,$rrr,$con)['pinHash'];
        $return['pin'] = base64_encode(base64_encode($pin));
        
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= "From: ESCOHSTI <no-reply@escohsti-edu.ng>\r\n".'X-Mailer: php';
        
        $message = "Dear $user <br> This is your pin for checking result. Don't share with anyone <br>pin: $pin";
        
       
        mail($email, 'Scratch Card Pin', $message, $headers);
        $return['msg'] = 'Payment successful and approved';
    
        echo json_encode($return);
    }else{
        //echo 'error, please contact support';
        echo $response9;
    }
    
    //echo $orderID;
}elseif($statusCode == '021' || $statusCode == '02' || $statuspaid == 'Transaction Pending'){
    echo $statuspaid;
}elseif($rrdata['Amount'] != $amountPaid){
   
    //echo $response;
    echo  'Amount Paid is not same with amount generate! Contact school authority for any error in payment';
}elseif($statusCode == '02'){
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    echo $statuspaid;
}else{
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    
    if($statuspaid == 'Transaction Pending'){
        echo 'Payment not successful';
    }else{
        echo $statuspaid;
    }
}



//echo json_decode($response)->status;


}elseif(isset($_GET['user']) && isset($_GET['rrr']) && isset($_GET['statusGet']) && isset($_GET['statusCodeGet'])){
    
$sha_value =  $orderID = $apiKey = "";
$statusGet = $_GET['statusGet'];
$statusCodeGet = $_GET['statusCodeGet'];
$rrr = $_GET['rrr'];
$seletFromID = 1;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 2;
//$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$base_url = apiCredential($seletFromID, 'base_url');
 
$hash_value =hash("sha512",$rrr.$ApiKey.$MerchantID);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{$base_url}/{$MerchantID}/{$rrr}/{$hash_value}/status.reg",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "Authorization: remitaConsumerKey=$MerchantID,remitaConsumerToken=".$hash_value 
  ),
));

$response = curl_exec($curl);

curl_close($curl);
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $user_id = $_SESSION['user_id'];
    $amountPaid = $amount = $update->amount;
    $payingFor ="2021/2022 Result scratch pin";
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    
    
    $sql_department = "SELECT Amount FROM paymentCategories WHere payCategories='scratch_pin'";
                                                $fees = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($fees)){
                                                   
                                                    $amt = $row['Amount'];
                                                      }
   
$stdID = user_data($_SESSION['user'], $con);
if(!empty($statusCode ) && $statusCode == '00' && $statuspaid == 'Successful' && $amt == $amountPaid){
    
     $datepaid = $update->paymentDate;
    $response9 =  updatePin($stdID,$refNNum,$statuspaid,$datepaid,$con);;
    
    if($response9 == 'Invoice Updated Sucessfully'){
        $alldata = Alluser_data($_SESSION['user'], $con);
        $email = $alldata['Email'];
        $user = $alldata['Username'];
        $pin = getDoubleData($stdID,$rrr,$con)['pinHash'];
        $return['pin'] = base64_encode(base64_encode($pin));
        
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= "From: ESCOHSTI <no-reply@escohsti-edu.ng>\r\n".'X-Mailer: php';
        
        $message = "Dear $user <br> This is your pin for checking result. Don't share with anyone <br>pin: $pin";
        
       
        mail($email, 'Scratch Card Pin', $message, $headers);
        $return['msg'] = 'Payment successful and approved';
    
        echo json_encode($return);
    }else{
        //echo 'error, please contact support';
        echo $response9;
    }
    
    //echo $orderID;
}elseif(!empty($statusCode ) && $statusCode == '01' && $statuspaid == 'Successful' && $amt == $amountPaid){
    
     $datepaid = $update->paymentDate;
    $response9 =  updatePin($stdID,$refNNum,$statuspaid,$datepaid,$con);;
    
    if($response9 == 'Invoice Updated Sucessfully'){
        $alldata = Alluser_data($_SESSION['user'], $con);
        $email = $alldata['Email'];
        $user = $alldata['Username'];
        $pin = getDoubleData($stdID,$rrr,$con)['pinHash'];
        $return['pin'] = base64_encode(base64_encode($pin));
        
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= "From: ESCOHSTI <no-reply@escohsti-edu.ng>\r\n".'X-Mailer: php';
        
        $message = "Dear $user <br> This is your pin for checking result. Don't share with anyone <br>pin: $pin";
        
       
        mail($email, 'Scratch Card Pin', $message, $headers);
        $return['msg'] = 'Payment successful and approved';
    
        echo json_encode($return);
    }else{
        //echo 'error, please contact support';
        echo $response;
    }
    
    //echo $orderID;
}elseif($statusCode == '021' || $statusCode == '02' || $statuspaid == 'Transaction Pending'){
    echo $statuspaid;
}elseif($rrdata['Amount'] != $amountPaid){
  
    echo 'Amount Paid is not same with amount generate! Contact school authority for any error in payment';
}elseif($statusCode == '02'){
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    echo $statuspaid;
}else{
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    if($statuspaid == 'Transaction Pending'){
        echo 'Payment not successful';
    }else{
        echo $statuspaid;
    }
}



//echo json_decode($response)->status;


}else{
    header('location:login.php');
}