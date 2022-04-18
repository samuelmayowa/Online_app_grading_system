<?php
include_once('functions.php');
require_once('connection.php');
$amount="";
$fullname=$rrdata="";
//if(isset($_POST['genInv'])){
  if(!isset($_SESSION['user'])){
     header('location:login.php?msg=You Must Login To Continue');
 }  
    
    
    $type = '2021/2022 Acceptance Fee';
    $status_p = 'Payment Reference generated';
    $status_s = 'Successful';
    $stdID = $user_id = $_SESSION['user_id'];
    $rrdata_p = getinvoiceWithType($stdID,$status_p,$type,$con);
    $rrdata_s = getinvoiceWithType($stdID,$status_s,$type,$con);
    if(!empty($rrdata_p)){
        $rrdata = $rrdata_p;
    }elseif(!empty($rrdata_s)){
        $rrdata = $rrdata_s;
    }
    $screenData = getuserdata($user_id,$con);
    
     $fname = $screenData['FirstName'];
    $lname = $screenData['LastName'];
    $midName = $screenData['MidName'];
    $email = $screenData['Email'];
    $username = $screenData['Username'];
    //$school = $screenData['school'];
    $payingFor = $type;
    $phno = $screenData['PhoneNumber'];
    $amount = $rrdata['Amount'];
    $refNNum= $rrdata['RefNum'];
    $status=$rrdata['InvoiceStatus'];
   // $statusCode = $rrdata['rrr_statuscode'];
    $orderID = $orderIDget = $rrdata['RefOrderID'];
    $stdID= $_SESSION['userID'];
    
$sha_value =  $orderID = $apiKey = "";
$seletFromID = 2;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
//$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 4;
$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$ApiKey = apiCredential($seletFromID, 'ApiKey');


$hash_value =hash("sha512",$MerchantID.$refNNum.$ApiKey);
    
    $responseUrl = 'https://'.$_SERVER['SERVER_NAME'].'/response_acceptance.php';
   

//}
  ?>

<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ile, Abiye" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
       <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        label{font-size:24px; padding:10px; font-family:Arial Black; }
            
        
        </style>
    </head>
    <body >
        <nav class="sb-topnav navbar navbar-expand navbar-gray bg-green" style="background-color:teal; color:#fff;">
            <a class="navbar-brand" href="index.html" style="color:#fff;">ESCOHST-IJERO</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0" style="color:#fff;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color:#fff;"  id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#myProfiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="UserdashBoard.php?user=<?php echo $_SESSION['user']; ?>" >Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Already paid? Enter RRR to validate</h3></div>

                                        <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php if(isset($upd)){ echo  $upd; } ?>
                                                        </h3>
                                                                        
                                                                        </div>
                                  
                                    
                                        <div class="card-body" style="text-align:center;">
                                        
                                        <p id="response"></p>
                                        <form action="#" name="SubmitRemitaForm" id="form-rrr" method="POST">

<input name="merchantId" value="<?php echo $MerchantID; ?>" type="hidden">

<!--<input name="merchantId" value="2547916" type="hidden">-->

<input name="hash" value="<?php echo $hash_value; ?>" type="hidden">

<!--<input name="hash" value="4f33dc2478836218506a12b4bb512f711eaadbf9ea521ba443a8da1bd233bf234c6f62d23b91675db2467aa2586e3d5f49e37cd594361c0938f30349410282cb"type="hidden">-->

<input class="form-control" placeholder="Enter RRR to validate payment" id="rrr" name="rrr" value="" type="number">

<!--<input name="rrr" value="280008217946" type="hidden">-->

<input name="responseurl" value="<?php echo $responseUrl; ?>" type="hidden">

<!--<input name="responseurl" value="http://www.startuppackng.com/response.php" type="hidden">-->


<div class="card-header"><h3 class="text-center font-weight-light my-4"><input id="submit" type ="submit" class="btn btn-primary" name="submit_btn" value="Validate"> </h3></div>
</form>
                                        
                                        
                                        

                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti. <?php echo date('Y')?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
     <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous">-->
     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
        
         <script type="text/javascript">
            $(document).ready( function(){
                
         $('#form-rrr').submit(function(e){
                    e.preventDefault()
                    var rrr = $("#rrr").val();
                    
                $("#submit").prop('disabled', true);
                      
        $.ajax({   
                            url:"/rrr-paymentstatus-acceptance.php?user=<?php echo $username; ?>&rrr="+rrr+"&orderId=<?php echo $orderIDget; ?>",
                            type: 'POST',
                            cache:false,
                            //data: dataString,
                            beforeSend: function() {},
                            timeout:10000,
                            error: function() {
                                /*Swal.fire({
                                title: "Error!",
                                text: "Error. Refresh and try again!",
                                type: "error",
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                                });*/
                             },    
                            success: function(response) {
                                $("#response").html(response+', Please wait...');
                               // alert("Deposit Placed");
                                /*Swal.fire({
                                title: "Success!",
                                text: "Success. "+response,
                                type: "success",
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                                });*/
                                
                                if(response === 'Payment successful and approved'){
                                    setTimeout(function() { 
                                    window.location.href = "/print_success_accept.php";
                                    
                                    }, 10000);
                                }else if(response === ''){
                                    setTimeout(function() { 
                                    window.location.href = "/";
                                    location.reload();
                                    }, 10000);
                                }else if(response === 'Payment not successful' || response === 'Transaction Pending'){
                                    setTimeout(function() { 
                                    window.location.href = "/payAcceptance.php";
                                   
                                    }, 10000);
                                }
                            
                            } 
                        });
         })          
    });
                        
       </script>
       
    </body>
</html>
