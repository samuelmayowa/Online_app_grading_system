<?php
session_start();
$amt="";
$hskey="";
$refNum="";
$refNum =$_SESSION['refNum'];
if(isset($_SESSION['amt'] ) ){
    $amt=$_SESSION['amt'];
   
}
echo "RefNum: ".$refNum. "<br />";
echo $amt = $_SESSION['amt'] . "<br />";
$curl = curl_init();
$apiKey=1946;
$orderID=697306016;
$servTypID=4430731;
$merchID=2547916;
$amt=30000;
//echo  "Your Hashed Key Is : ". $hskey= JSON.stringify(SHA512('$merchID'.'$servTypID'.'$orderID'.'$amt'.'$apiKey'));\
echo $orderID= "ESCOHSTI" . rand(10000000000,999999999999999);
 $orderid_t = "OrderID: " . $orderID ."<br />";
$hash_value =hash("sha512",$merchID.$servTypID.$orderID.$amt.$apiKey);
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{ 
	"serviceTypeId": "4430731",
	"amount": "30000",
	"orderId": "697306016",
	"payerName": "John Doe",
	"payerEmail": "doe@gmail.com",
	"payerPhone": "09062067384",
	"description": "2021/2022 Acceptance Fees"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: remitaConsumerKey=2547916,remitaConsumerToken='.$hash_value
  ),
));

$response = curl_exec($curl);

curl_close($curl);
print_r($response);
?>