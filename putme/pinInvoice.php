<?php
include 'functions.php';

if(isset($_POST['invoice'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $fname = $screenData['fname'];
    $lname = $screenData['lname'];
    $midName = $screenData['MidName'];
    $email = $screenData['email'];
    $school = $screenData['school'];
    $payingFor = $screenData['payingFor'];
    $phno = $screenData['phno'];
    $amount = $screenData['amount'];
    $refNNum= $screenData['rrr_value'];
    $status = $screenData['rrr_status'];
    $statusCode = $screenData['rrr_statuscode'];
    $orderID= $_SESSION['orderID'];
    
    if($statusCode == '025' && !empty($refNNum)){
        $rrr = $refNNum;
        $orderId = $orderID; 
        $count = 0; 

        $stdID = user_data($_SESSION['user'], $con);
        
        function genpin($con){
            $create = rand(1000000000, 9999999999);
            $getpin = pincheck($create, $con);
            if(!empty($getpin)){
                $create = genpin($con);
            } 
            return $create;
        }
        
        $pin = genpin($con);
        
        $rrdata = getDoubleData($stdID,$rrr,$con);
        if(empty($rrdata)){
            $success= savepinInvoice($stdID,$pin,$rrr,$count,$status,$orderId,$con);
        }
        
    
    }else{
        $username = $_SESSION['user'];
       header("location:genrrr.php?user={$username}"); 
    }
    if($success){
        $msg=$success;
        echo "<script> alert('$success');</script>";
    }
}else{
    $user =$_SESSION['user'];
    $query = mysqli_query($con, "SELECT * FROM userAccounts Where Username ='$user'");
    if(!$query){
        $msg ="Unable To Find User Details".mysqli_error($con);
    }else{
        $amount="";
        $sql_department = "SELECT Amount FROM paymentCategories WHERE payCategories='scratch_pin'";
        $fees = mysqli_query($con,$sql_department);
        while($row = mysqli_fetch_assoc($fees)){
            $amount = $row['Amount'];
         }
        while($results = mysqli_fetch_array($query)){
            $id = $results['ID'];
            $fname = $results['FirstName'];
            $midName = $results['MidName'];
            $lname =$results ['LastName'];
            $email = $results['Email'];
            $phno = $results['PhoneNumber'];
            $_SESSION['user_id'] = $id;
             
        }
        $stdID = user_data($_SESSION['user'], $con);
        $query_card = "SELECT * FROM scratchCards WHERE userId = '$stdID' AND pinCounts = '0' AND pinStatus = 'Payment Reference generated'";
        $q_card = mysqli_query($con,$query_card);
        while($v = mysqli_fetch_assoc($q_card)){
            $orderID = $v['orderID'];
            $refNNum = $v['RRR'];
         }
        $payingFor = $screenData['payingFor'];
    }
}

$seletFromID = 1;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 5;
//$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$ApiKey = apiCredential($seletFromID, 'ApiKey');


$hash_value =hash("sha512",$MerchantID.$refNNum.$ApiKey);
    
$responseUrl = 'https://'.$_SERVER['SERVER_NAME'].'/response_pin.php';
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
                        <a class="dropdown-item" href="myProfiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Invoice For 2020/21 Result Scratch Card</h3></div>

                                        <div class="card-header"><span style="color:red; font-size:11px;"><?php if(isset($msg)){ echo  $msg; } ?> </span>  </div>
                                  
                                    <div class="card-body">
                                        <label><h3>Student Details</h3></label><span style="color:red; font-size:9px;">NOTE: You Are Adviced to Print This page Before Proceed to Payment</span> 
                                        <!--<form action="payInvoice.php" method="POST"> -->
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" name="fname" value="<?php if(isset($fname)){ echo $fname; } ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" name="lname" placeholder="Enter Surname"  value="<?php if(isset($lname)){ echo $lname; } ?>" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">OtherName</label>
                                                        <input class="form-control py-4" id="inputPassword" name="Othername" type="text" placeholder="Enter OtherNames"  value="<?php if(isset($midName)){ echo $midName; } ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Programme</label>
                                                        <input class="form-control py-4" id="inputProg" name="prog" type="text" placeholder="Enter programme"  value="Full Time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address"  value="<?php if(isset($email)){ echo $email; } ?>" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Phone Number</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="phno" type="tex" aria-describedby="phonelHelp" placeholder="Enter Phone Number"   value="<?php if(isset($phno)){ echo $phno; } ?>" readonly/>
                                            </div>
                                            <div class="form-row">
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Schools</label>
                                                        <input class="form-control py-4" id="inputSchools" name="school" type="text" placeholder="Enter Schools" readonly  value="<?php if(isset($school)){ echo $school; } ?>" />
                                                         
                                                    </div>
                                                </div>-->
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Paying For</label>
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="Service Paid Form" value="2020/21 Result Scratch Pin"  readonly/>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword"> Reference Number(RRR)</label>
                                                        <input class="form-control py-4" id="inputRRR" name="refNum" type="text" placeholder="RRR" readonly   value="<?php if(isset($refNNum)){ echo $refNNum; } ?>" />
                                                         
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Application Fee</label>
                                                <input class="form-control py-4" id="inputamount" name="amount" type="tex" aria-describedby="amountHelp" placeholder="Enter Amount"   value="<?php if(isset($amount)){ echo $amount; } ?>" readonly />
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Reference Order ID:</label>
                                                        <input class="form-control py-4" id="inputSchools" name="orderID" type="text" placeholder="Your Transaction Order ID" readonly  value="<?php if(isset($orderID)){ echo $orderID; } ?>" />
                                                         </div>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                <div class="col-md-6">
                                            <div class="form-group">
<!--<form action="https://login.remita.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" method="POST">-->
   <form action="https://remitademo.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" method="POST">                                             
<input name="merchantId" value="<?php echo $MerchantID; ?>" type="hidden">

<!--<input name="merchantId" value="2547916" type="hidden">-->

<input name="hash" value="<?php echo $hash_value; ?>" type="hidden">

<!--<input name="hash" value="4f33dc2478836218506a12b4bb512f711eaadbf9ea521ba443a8da1bd233bf234c6f62d23b91675db2467aa2586e3d5f49e37cd594361c0938f30349410282cb"type="hidden">-->

<input name="rrr" value="<?php echo $refNNum; ?>" type="hidden">

<!--<input name="rrr" value="280008217946" type="hidden">-->

<input name="responseurl" value="<?php echo $responseUrl; ?>" type="hidden">

<!--<input name="responseurl" value="http://www.startuppackng.com/response.php" type="hidden">-->

 <div class="form-group mt-4 mb-0"><button type="submit" name="submit_btn" class="btn btn-primary btn-block">Pay Via Remitat</button></div>
</form>

                                           
                                            </div>
                                            </div>
                                        
                                       
                                       <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" onclick="window.print()">Print this Invoice</button></div>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <p style="font-size: 16px;" class="badge badge-success">Paid already in bank?</p>
                                                    <div class="form-group mt-4o mb-0"><a href="/manualpin-rrr.php" class="btn btn-primary btn-block" >Click to Validate RRR</a></div>
                                                 </div>
                                                     <div class="card-footer text-center">
                                        <div class="small"><a href="UserdashBoard.php?user=<?php if(!empty($username)) { echo $username; } ?>"> >>>Back</a></div>
                                            </div>
                                            <!--</form>-->
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
