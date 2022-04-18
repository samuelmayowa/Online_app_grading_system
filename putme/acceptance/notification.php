<?php
$ch =curl_init();

//set options 

curl_setopt($ch, CURLOPT_URL, 'https://remitademo.net/remita/exapp/api/v1/send/api/bgatesvc/v3/billpayment');

//return instead of outpiut directly

curl_setopt($ch, CURLOPT_RETURN_TRANSFER, 1);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);

// whether to include header information or not

curl_setopt($ch, CURLOPT_HEADER,'Authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c');

//Executte the request and fetch the respoinse

$output= curl_exec($ch);

if($output == FALSE){
    echo "cURL Error : " . curl_error($ch);
    
}

//close aND FREE UP THE curl handle

curl_close($ch);

// display rrsponse data

print_r($output);




?>