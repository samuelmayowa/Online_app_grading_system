<!--<script> var hash = CryptoJS.SHA512("$merchID"."$servTypID"."$orderID"."$amt"."$apiKey"); alert(hash); </script>-->
<?php

$hs="";
$apiKey=1946;
$orderID=697306016;
$servTypID=4430731;
$merchID=2547916;
$amt=30000;
//$hs='<script> var hash = CryptoJS.HmacSHA512("$merchID"."$servTypID"."$orderID"."$amt"."$apiKey"); </script>';
 //echo "HAshed Key". $hs;
 $header=array();

 $header [] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c 
                Content-Type: application/json';
$curl = curl_init();

 curl_setopt($curl, CURLOPT_URL,'https://remitademo.net/remita/exapp/api/v1/send/api/bgatesvc/v3/billpayment');
// curl_setopt($curl, CURLOPT_URL,'https://www.classicsystemscsil.com');
 curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
  /*  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: remitaConsumerKey=2547916,remitaConsumerToken=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c'
  ),*/
curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
 $result = curl_exec($curl);
 $result = json_decode($result);
 echo  $result;

?>

<?php

/*$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/bgatesvc/v3/billpayment/biller/transaction/initiate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{ 
 "billPaymentProductId":"2086009531",
	   "amount":3500.00,
	   "transactionRef":"35896767809",
	   "name":"Mike Oshadami",
	   "email":"oshadami@xyz.com",
	   "phoneNumber":"080123456789",
	   "customerId":"oshadami@xyz.com",
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: remitaConsumerKey=2547916,remitaConsumerToken=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/


?>