<?php 
include_once('functions.php');
require_once('connection.php');
$amount="";
$fname="";
$amt="";
$phone="";
$descr="";
if(isset($_GET['user']) && isset($_GET['email'])){
$descr="2021/2022 PUTME Form";
 $amount = 2000;
if(isset($_GET['user']) && isset($_GET['email'])){
    $regnum = $_GET['user'];
    $email = $_GET['email'];
     $query = mysqli_query($con, "SELECT * From jamb_data Where RG_NUM ='$regnum'");
	if($query){
	    $usr =mysqli_num_rows($query) ;
	  if(!empty($usr)){
	      while($user=mysqli_fetch_array($query)){
	          $id=$user['id'];
	          $regno=$user['RG_NUM'];
	          $name = $user['RG_CANDNAME'];
	          $sex = $user['RG_SEX'];
	          $state = $user['STATE_NAME'];
	          $score = $user['RG_AGGREGATE'];
	          $lga = $user['LGA_NAME'];
	          $phone = $user['PHONE NUMBER'];
	      }
	  }
	}else{
    header("location:sign_in.php"); 
}
}

$sha_value =  $orderID = $apiKey = "";
$seletFromID = 2;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
//$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 5;
$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
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
    header("location:sign_in.php");
}
