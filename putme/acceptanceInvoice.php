<?php
include 'functions.php';
if(!isset($_SESSION['user'])){
    header('location:login.php?msg=Login to continue!');
}

$std_reg = user_data($_SESSION['user'], $con);
$score = user_score($std_reg, $con)['score'];
if(!$score){
    $username = $_SESSION['user'];
    header("location:UserdashBoard.php?user={$username}&msg=Only Admitted students can access acceptance fees page!");
}

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
    $stdID= $_SESSION['user_id'];
    if($statusCode == '025' && !empty($refNNum)){
        $type = '2021/2022 Acceptance Fee';
        $status_p = 'Payment Reference generated';
        $status_s = 'Successful';
        $stdID = $user_id = $_SESSION['user_id'];
        $rrdata_p = getinvoiceWithType($stdID,$status_p,$type,$con);
        $rrdata_s = getinvoiceWithType($stdID,$status_s,$type,$con);
        if(empty($rrdata_p) && empty($rrdata_s)){
            $success= saveInvoice($stdID,$amount,$payingFor,$orderID,$refNNum,$status,$con);
        }
    
    }else{
       header("location:acceptance.php?user={$username}"); 
    }
    if($success){
        $msg=$success;
        echo "<script> alert('$success');</script>";
    }
}else{
   
    $type = '2021/2022 Acceptance Fee';
    $status = 'Payment Reference generated';
    $stdID = $user_id = $_SESSION['user_id'];
    $rrdata = getinvoiceWithType($stdID,$status,$type,$con);
    $statusPaid = 'Successful';
    $rrdataPaid = getinvoiceWithType($stdID,$statusPaid,$type,$con);
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
    $orderID= $rrdata['RefOrderID'];
    $stdID= $_SESSION['userID'];
    if(!empty($rrdataPaid)){
    header("location:print_success_accept.php?user={$username}");
}elseif(empty($rrdata)){
    header("location:UserdashBoard.php?user={$username}");
}
}
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Invoice For 2021/2022 Acceptance Fee </h3></div>

                                        <div class="card-header"><span style="color:red; font-size:11px;"><?php if(isset($msg)){ echo  $msg; } ?> </span>  </div>
                                  
                                    <div class="card-body">
                                        <label><h3>Student Details</h3></label><span style="color:red; font-size:9px;">NOTE: You Are Adviced to Print This page Before Proceed to Payment</span> 
                                        <form action="payAcceptance.php" method="POST"> 
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
                                                        <label class="small mb-1" for="inputConfirmPassword">Description</label>
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="Service Paid Form" value="2021/2022 Acceptance Fee"  readonly/>
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
                                                <label class="small mb-1" for="inputEmailAddress">Acceptance Fee</label>
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
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="genInv" class="btn btn-primary btn-block">Proceed To Invoice payment</button></div>
                                            </div>
                                            </div>
                                        
                                       
                                       <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" onclick="window.print()">Print this Invoice</button></div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Already paid? click to validate manually
                                             </p>
                                            <div class="form-group mt-4 mb-0"> <a  href="/manual-rrr-acp.php"  class="btn btn-primary btn-block" >Validate RRR</a></div>
                                            </div>
                                            </div>
                                            <div class="form-row">
                                                <!--<div class="col-md-6">
                                                    <p style="font-size: 16px;" class="badge badge-success">Paid already in bank?</p>
                                                    <div class="form-group mt-4o mb-0"><a href="/a_manual-rrr.php" class="btn btn-primary btn-block" >Click to Validate RRR</a></div>
                                                 </div>-->
                                                     <div class="card-footer text-center">
                                        <div class="small"><a href="UserdashBoard.php?user=<?php if(!empty($username)) { echo $username; } ?>"> >>>Back</a></div>
                                            </div>
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
