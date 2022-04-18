<?php 
include_once('functions.php');
require_once('connection.php');
$amount="";
$fname="";
$email="";
$amt="";
$phone="";
$descr="";
if(isset($_GET['user'])){
$descr="2021/2022 Application Form";
$sql_department = "SELECT Amount FROM paymentCategories WHere payCategories='Application Form Fees'";
                                                $fees = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($fees)){
                                                   
                                                    $amount = $row['Amount'];
                                                      }
$user_username_session =$_SESSION['user'];
$user_username_cookie = $_COOKIE['user'];
if($user_username_session){
    $user_data = mysqli_query($con, "SELECT * FROM userAccounts Where Username ='$user_username_session'");
    $fetch_user_data = mysqli_fetch_assoc($user_data);
    $name = $fetch_user_data['LastName'].' '.$fetch_user_data['FirstName'].' '.$fetch_user_data['MidName'];
     $phone = $fetch_user_data['PhoneNumber'];
    $email = $fetch_user_data['Email'];
    
}elseif($user_username_cookie){
    $user_data =  mysqli_query($con, "SELECT * FROM userAccounts Where Username ='$user_username_cookie'");
    $fetch_user_data = mysqli_fetch_assoc($user_data);
    $name = $fetch_user_data['LastName'].' '.$fetch_user_data['FirstName'].' '.$fetch_user_data['MidName'];
    $phone = $fetch_user_data['PhoneNumber'];
    $email = $fetch_user_data['Email'];
    $lname = $fetch_user_data['LastName'];
    $fname=$fetch_user_data['FirstName'];
}

$sha_value =  $orderID = $apiKey = "";
$seletFromID = 1;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$base_url = apiCredential($seletFromID, 'base_url');

$amt = $amount;
 $orderID=rand(10000000000,999999999999999).$MerchantID;
 $orderid_t = "OrderID: " . $orderID ."<br />";
$hash_value =hash("sha512",$MerchantID.$ServiceTypeID.$orderID.$amount.$ApiKey);
$curl = curl_init();
 $_SESSION['orderID'] = $orderID;
curl_setopt_array($curl, array(
  CURLOPT_URL => "{$base_url}/merchant/api/paymentinit",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{ 
    "serviceTypeId": '.$ServiceTypeID.',
	"amount": '.$amt.',
	"orderId": '.$orderID.',
	"payerName": "'.$name.'",
	"payerEmail": "'.$email.'",
	"payerPhone": "'.$phone.'",
	"description": "'.$descr.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "Authorization: remitaConsumerKey=$MerchantID,remitaConsumerToken=".$hash_value 
  ),
));

$response = curl_exec($curl);
//echo $response;

 $resp= json_decode($response, true);

curl_close($curl);

echo $response;

}else{
    header('location:login.php');
}
