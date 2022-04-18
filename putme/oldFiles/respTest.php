<?php 
include_once('functions.php');
require_once('connection.php');




//SHA512 (rrr/orderId+api_key+merchantId)
if(isset($_GET['RRR']) && isset($_GET['orderID'])){
    $sha_value =  $orderID = $apiKey = "";
$seletFromID = 1;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
//$ApiKey = apiCredential($seletFromID, 'ApiKey');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
    $rrr=$_GET['RRR'];
    $orderID=$_GET['orderID'];
    $username= $_SESSION['user'];
    
   echo  $hash_value =hash("sha512",$rrr.'/'.$orderID.$ApiKey.$MerchantID);
    /*echo $transactions='<table>
                    <tr><td>RRR</td><td>Action</td><td> Order ID</td></tr>
                    <tr><td>'.$rrr.'</td>
                    <td><form method ="GET" action="https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/'.$MerchantID.'/'.$orderID.'/'.$hash_value.'/orderstatus.reg"><button>Get Status</button></form></td><td>'.$orderID.'</tr>
                    </table>';*/
}

?>
