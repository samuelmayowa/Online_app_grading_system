<?php
include 'functions.php';

if(isset($_GET['regnum'])){
    $regnum = $_GET['regnum'];
     $query = mysqli_query($con, "SELECT * From jamb_data Where RG_NUM ='$regnum'");
	if($query){
	    $usr =mysqli_num_rows($query) ;
	  if(!empty($usr)){
	      while($user=mysqli_fetch_array($query)){
	          $id = $user['id'];
	          $regno = $user['RG_NUM'];
	          
	          $sex = $user['RG_SEX'];
	          $state = $user['STATE_NAME'];
	          $score = $user['RG_AGGREGATE'];
	          $lga = $user['LGA_NAME'];
	          $phone = $user['PHONE NUMBER'];
	          $email = $user['std_email'];
	          $rrr = $user['RRR'];
	          $status = $user['status'];
	          $fullname = $user['RG_CANDNAME'];
	           $amount = $user['amount'];
	          $order_id = $user['order_id'];
	      }
	  }else{
        header("location:sign_in.php"); 
    }
	}else{
        header("location:sign_in.php"); 
    }
}else{
        header("location:sign_in.php"); 
    }
    
    if($status != 'Successful'){
        header("location:putme_invoice.php?regnum=".$regnum);
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
         <?php //include('topbar.php'); ?>
        
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Receipt For 2021/22 Online PUTME Form </h3></div>

                                        <div class="card-header"><span style="color:red; font-size:11px;"><?php if(isset($msg)){ echo  $msg; } ?> </span>  </div>
                                  
                                    <div class="card-body">
                                        <label><h3>Student Details</h3></label><span style="color:red; font-size:9px;">NOTE: You Are Adviced to Print This Receipt Before Proceed to Exams</span> 
                                        <form action="#" method="POST"> 
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Full Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter full name" name="fname" value="<?php if(isset($fullname)){ echo $fullname; } ?>" readonly />
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
                                                    <input class="form-control py-4" id="inputEmailAddress" name="phno" type="tex" aria-describedby="phonelHelp" placeholder="Enter Phone Number"   value="<?php if(isset($phone)){ echo $phone; } ?>" readonly/>
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
                                                
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Paid For</label>
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="Service Paid Form" value="2021/22 UTME Form"  readonly/>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword"> Reference Number(RRR)</label>
                                                        <input class="form-control py-4" id="inputRRR" name="refNum" type="text" placeholder="RRR" readonly   value="<?php if(isset($rrr)){ echo $rrr; } ?>" />
                                                         
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
                                                        <input class="form-control py-4" id="inputSchools" name="orderID" type="text" placeholder="Your Transaction Order ID" readonly  value="<?php if(isset($order_id)){ echo $order_id; } ?>" />
                                                         </div>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                <!--<div class="col-md-6">
                                            <div class="form-group">
                                            <<div class="form-group mt-4 mb-0"><a href="/applications.php" class="btn btn-primary btn-block">Proceed To Application</a></div>
                                            </div>
                                            </div>-->
                                        
                                       
                                       <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" onclick="window.print()">Print this Invoice</button></div>
                                            </div>
                                            </div>
                                            </div>
                                            </form>
                                            <div class="card-footer text-center">
                                       
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
