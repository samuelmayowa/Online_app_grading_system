<?php
include 'functions.php';
$amount = 2000;
if(isset($_POST['invoice'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $regnum = $screenData['regnum'];
    $email = $screenData['email'];
    
    $query = mysqli_query($con, "SELECT * From jamb_data Where RG_NUM ='$regnum'");
	if($query){
	    $usr =mysqli_num_rows($query) ;
	  if(!empty($usr)){
	      while($user=mysqli_fetch_array($query)){
	          $id=$user['id'];
	          $regno=$user['RG_NUM'];
	          $name = $user['RG_CANDNAME'];
	          $sex = $user['RG_SEX'];
	          $state = $user['STATE_NAME'];
	          $score = $user['RG_AGGREGATE'];
	          $lga = $user['LGA_NAME'];
	          $phone = $user['PHONE NUMBER'];
	      }
	  }
	}else{
        header("location:sign_in.php"); 
    }
    $refNNum= $screenData['rrr_value'];
    $status = $screenData['rrr_status'];
    $statusCode = $screenData['rrr_statuscode'];
    $orderID= $_SESSION['orderID'];
    $stdID= $regnum;
    if($statusCode == '025' && !empty($refNNum)){
        $type = '2021/2022 PUTME Fee';
        $status_p = 'Payment Reference generated';
        $status_s = 'Successful';
        $stdID = $regnum;
        $rrdata_p = getPUTMEinvoice($stdID,$status,$con);
        $rrdata_s = getPUTMEinvoice($stdID,$status,$con);
        if(empty($rrdata_p) && empty($rrdata_s)){
            $success= savePUTMEInvoice($stdID,$amount,$orderID,$refNNum,$status,$email,$con);
        }
    
    }else{
       header("location:sign_in.php?user={$regnum}"); 
    }
    if($success){
        $msg=$success;
        echo "<script> alert('$success');</script>";
    }
}else{
    $regnum = $_GET['regnum'];
    if(!$regnum){
        header("location:sign_in.php");
    }
    $query = mysqli_query($con, "SELECT * From jamb_data Where RG_NUM ='$regnum'");
	if($query){
	    $usr =mysqli_num_rows($query) ;
	  if(!empty($usr)){
	      while($user=mysqli_fetch_array($query)){
	          $id=$user['id'];
	          $regno=$user['RG_NUM'];
	          $name = $user['RG_CANDNAME'];
	          $sex = $user['RG_SEX'];
	          $state = $user['STATE_NAME'];
	          $score = $user['RG_AGGREGATE'];
	          $lga = $user['LGA_NAME'];
	          $phone = $user['PHONE NUMBER'];
	          $email = $user['std_email'];
	      }
	    }
	}
    $type = '2021/2022 PUTME Fee';
    $status = 'Payment Reference generated';
    $stdID = $regnum;
    $rrdata = getPUTMEinvoice($stdID,$status,$con);
    $statusPaid = 'Successful';
    $rrdataPaid = getPUTMEinvoice($stdID,$statusPaid,$con);
    $refNNum= $rrdata['RRR'];
    $status=$rrdata['status'];
    $orderID= $rrdata['order_id'];
    if(!empty($rrdataPaid)){
    header("location:print_success_putme.php?user={$regnum}");
}elseif(empty($rrdata)){
    header("location:sign_in.php");
}
}
  ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-UTME-Login</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        /*label{font-size:24px; padding:10px; font-family:Arial Black; }*/
            
        
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-lg mt-8">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"> UTME Candidates Screening /RRR Generation </h3></div>
                                    <div class="card-body">
                                        <div class="card-header"><h6 class="text-center font-weight-light my-4" style="color:#23c745; font-family:Arial Black;"> Generate RRR</h6></div>
                                        <form action="putme_pay.php?reg=<?php echo $regnum?>" Method="POST" id="jambform">
                                          
                                    <div class="form-group"><label class="small mb-1" for="regnum">Jamb Reg No: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $regno?>" placeholder="regnum" name="regnum"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="name">Name: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $name?>" placeholder="Name" name="name"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="Email">Email: (Note: Make sure to use your email address. Do not use cybercafe's email address as this may cause disqualification of application.) &nbsp; </label><input readonly class="form-control py-4" value="<?php echo $email?>" type="text" placeholder="Email" id="email"name="email"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="phone">Phone: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $phone?>" placeholder="Phone" name="phone"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="sex">Sex: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $sex?>" placeholder="Sex" name="sex"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="score">Amount: &nbsp; </label><input readonly class="form-control py-4" type="text"value="#2000" placeholder="Amount" name="amount"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="score">RRR: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $refNNum?>" placeholder="Amount" name="amount"  required /></div>
                                    
                                   
                                             <div class="form-row">
                                                <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="putmepay" class="btn btn-primary btn-block">Proceed To Invoice payment</button></div>
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
                                            <div class="form-group mt-4 mb-0"> <a  href="/manual-rrr-putme.php?regno=<?php echo $regnum?>"  class="btn btn-primary btn-block" >Validate RRR</a></div>
                                            </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <!--<div class="card-footer text-center">
                                        <div class="small" style="color:maroon;">
                                            <a href="createAccount.php" style="color:maroon;"> Already Verified and Paid(for UTME)? (Create User Account Here) Or Sign up! &nbsp; &nbsp; &nbsp;</a> || &nbsp; &nbsp; &nbsp;
                                            <a href="https://eportal.escohsti-edu.ng/" style="color:maroon;"> >> Return To Portal Home</a>
                                        </div>
                                        <div class="small" style="color:maroon;">
                                            <a href="login.php" style="color:maroon;">Already Screened (for UTME)? (Check Admission Status) Or Sign up! &nbsp; &nbsp; &nbsp;</a> || &nbsp; &nbsp; &nbsp;
                                            <a href="https://eportal.escohsti-edu.ng/" style="color:maroon;"> >> Return To Portal Home</a>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <span>&nbsp;</span>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted" style="Text-align:center;">Copyright &copy; Ekiti State College Of Health Science and Technology, PMB 316, Epe-Ijero Road, Ijero-Ekiti, Ekiti State, Nigeria. 2021</div>
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
         <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
      
        
    </body>
</html>

                  