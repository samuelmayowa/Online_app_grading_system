


<?php

for($i=0;$i<=100;$i++) {
echo sprintf("%05d", $i) . "<br>";
}
function getFiveDigitId( $numericId){
  $id = $numericId/100000; // will give you 0.00001
  $strId = strVal($id); // convert to string 
  if(startsWith($strId, "0.")){
   return substr($strId, 1);
}else{
  return $numericId;
}
}

session_start();
$amt="";
$refNum="";
$refNum =$_SESSION['refnum'];
if(isset($_SESSION['amt'] ) ){
    $amt=$_SESSION['amt'];
   
}
echo "RefNum: ".$refNum. "<br />";
echo $_SESSION['amt'] . "<br />";
$curl = curl_init();
$apiKey=1946;
$orderID=$refNum;
$servTypID=4430731;
$merchID=2547916;
$apiHash=JSON.stringify($merchID).JSON.stringify($apiKey) ;
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/bgatesvc/v3/billers',
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
   'Authorization: Bearer beeyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>