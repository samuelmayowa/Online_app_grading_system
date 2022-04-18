<?php
include 'functions.php';
$std_reg = user_data($_SESSION['user'], $con);
$score = user_score($std_reg, $con)['score'];
if(!$score){
    $username = $_SESSION['user'];
    header("location:UserdashBoard.php?user={$username}&msg=Only Admitted students can access compulsory fees page!");
}
$adminContact = "Mail : admin@escohsti-edu.ng <br />
                    FOR ENQUIRY PLEASE CONTACT: 08130925149 OR 08038143003";

    $type = '2021/2022 Compulsory Fee';
    $stdID = $user_id = $_SESSION['user_id'];
    $statusPaid = 'Successful';
    $statusNotPaid = 'Payment Reference generated';
    $rrdataPaid = getinvoiceWithType($stdID,$statusPaid,$type,$con);
    $rrdataNotPaid = getinvoiceWithType($stdID,$statusNotPaid,$type,$con);
    $screenData = getuserdata($user_id,$con);
    
     $fname = $screenData['FirstName'];
    $lname = $screenData['LastName'];
    $midName = $screenData['Othername'];
    $email = $screenData['Email'];
    $username = $screenData['Username'];
    //$school = $screenData['school'];
    $payingFor = $type;
    $phno = $screenData['PhoneNumber'];
    $amount = $rrdataPaid['Amount'];
    $refNNum= $rrdataPaid['RefNum'];
    $status=$rrdataPaid['InvoiceStatus'];
   // $statusCode = $rrdataPaid['rrr_statuscode'];
    $orderID= $rrdataPaid['RefOrderID'];
    $stdID= $_SESSION['userID'];
    
  if(empty($rrdataPaid)){
      if(empty($rrdataNotPaid)){
          header("location:UserdashBoard.php?user={$username}");
      }elseif(!empty($rrdataNotPaid)){
          header("location:compInvoice.php?user={$username}");
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
         <?php include('topbar.php'); ?>
        
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Receipt For 2021/2022 Compulsory Fee</h3></div>

                                        <div class="card-header"><span style="color:red; font-size:11px;"><?php if(isset($msg)){ echo  $msg; } ?> </span>  </div>
                                  
                                    <div class="card-body">
                                        <label><h3>Student Details</h3></label><span style="color:red; font-size:9px;">NOTE: You Are Adviced to Print This page Before Proceed to Application</span> 
                                        <form action="#" method="POST"> 
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
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Phone Number</label>
                                                    <input class="form-control py-4" id="inputEmailAddress" name="phno" type="tex" aria-describedby="phonelHelp" placeholder="Enter Phone Number"   value="<?php if(isset($phno)){ echo $phno; } ?>" readonly/>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label class="small mb-1" for="inputEmailAddress">Payment Status</label>
                                                        <input class="form-control py-4" id="inputEmailAddress" name="status" type="tex" aria-describedby="phonelHelp" placeholder="Payment Status"   value="<?php if(isset($status)){ echo $status; } ?>" readonly/>
                                                    </div>
                                                </div>
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
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="Service Paid Form" value="2021/2022 Compulsory Fee"  readonly/>
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
                                            <div class="form-group mt-4 mb-0"><a href="https://eportal.escohsti-edu.ng/studentArea/" class="btn btn-primary btn-block">Proceed To Student Portal To Login / Pay School Fees </a></div>
                                            </div>
                                            </div>
                                        
                                       
                                       <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" onclick="window.print()">Print this Invoice</button></div>
                                            </div>
                                            </div>
                                            </div>
                                            </form>
                                            <div class="card-footer text-center">
                                        <?php echo $adminContact; ?>
                                        <div class="small"><a href="logout.php" class="btn btn-primary btn-block"> >>Logout</a></div>
                                    </div>
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
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti. 2021</div>
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
