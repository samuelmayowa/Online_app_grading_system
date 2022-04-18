<?php
session_start();
include_once('functions.php');
require_once('connection.php');
if(isset($_POST['proceed'])){
    
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $regnum = $screenData['regnum'];
    $email = $screenData['email'];
    $statusn = 'Payment Reference generated';
    
    $rrdata = getPUTMEinvoice($regnum,$statusn,$con);
    $statusPaid = 'Successful';
    $rrdataPaid = getPUTMEinvoice($regnum,$statusPaid,$con);
    $payingFor = $type;
    $refNNum= $rrdata['RRR'];
    $status=$rrdata['status'];
    $orderID= $rrdata['order_id'];
    if(!empty($rrdataPaid)){
        header("location:print_success_putme.php?user={$regnum}");
    }elseif(!empty($rrdata)){
        header("location:putme_invoice.php?regnum=".$regnum);
    }else{
         header("location:putme_gen.php?user={$regnum}&email={$email}"); 
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
            <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ekiti State College Of HSTI  News Board</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                
                <h2  class="text-center font-weight-light my-4">ATTENTION: IMPORTANT NOTICE  For 2021/2022 Admission Process </h2>

<hr>
<h3  class="text-center font-weight-light my-4"> Revalidate Your ACCEPTANCE FEES Payment RRR to Print Out Your Acceptance [SLIP]  Receipt</h3>
<hr>
<p data-bracket-id="23">
     Latest Updates: <br>
    <h5>APPLICATION FORM FEE: FOR UTME APPLICATION FES IS <code>#2000  (TWO THOUSAND NAIRA ONLY)) Excluding Bank Charges.</code> </h5><br></code></h5><br>
     <h4>Notification:</h4> <hr />
   3. ONCE YOUR ELIGIBILITY IS CONFIRMED, YOU'RE THEN AUTOMATICALLY REDIRECTED TO GENERATE INVOICE FOR THE POST UTME 2021/2022 APPLICANTION SCREENING APPLICATION FORM <hr /><br>
   4. CLICK ON GENERATE INVOCE INCASE AN INVOICE WAS NOT AUTOMATICALLY GENERATED FOR YOU FOR THE 2021/2022 POST UTME Screening APPLICATION <hr /><br>
   5. REVIEW YOUR DETAILS AND CLICK PAYMENT. <hr /> <br>
   IT WILL REDIRECT YOU TO THE ONLINE PAYMENT PLATFORM. <hr /><br> 
   SELECT YOUR CARD TYPE (MASTER CARD, VISA, VERVE ETC).  <hr /><br>
   ENTER YOUR DEBIT/ATM CARD DETAILS, CLICK ‘PAY’ AND WAIT WHILE YOU ARE REDIRECTED BACK TO THE PORTAL. <hr /> <br>
   PRINT YOUR RECEIPT AND PROCEED TO THE CAMPUS FOR YOUR ADMISSION PROCESS. <hr /> <br>
     <br>
     
      
<br>
    <br>
<!--<a href="register.php" target="_blank" align="center"><button type="button">Proceed to Create Profile</button></a><hr>-->
    <br>
<span style="color:#322; font-size:16px;">Phone: +2348130925149 OR +2348038143003 <br> 
Email: admins@escohsti-edu.ng
</span>
    <br>
    - Management
       
</p>

            </div>
        </div>
    </div>
</div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-lg mt-8">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"> UTME Candidates Screening / Verification </h3></div>
                                    <div class="card-body">
                                        <div class="card-header"><h6 class="text-center font-weight-light my-4" style="color:#23c745; font-family:Arial Black;"> Verify Your Admission With Your UTME Registration Number</h6></div>
                                        <form  Method="POST" id="jambform">
                                            <div class="form-group">
                                                 <p id="response"></p>
                                                <label class="small mb-1" id="utj"for="inputEmailAddress">UTME REG NUMBER: &nbsp; </label><span style="color:red; font-size:12px;"><?php if(isset($msg)){ echo  $msg; }?> </span>
                                                <input class="form-control py-4" id="regnum" type="text" placeholder="Enter Jamb Registration Number" name="regnum"  required />
                                            </div>
                                            
                                           
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!--<a class="small" href="#password.html">Forgot Password?</a>-->
                                                <button class="btn btn-primary" id="submit" name="login" type="submit">Verify My Eligibility</button>
                                                <div id="info"> </div>
                                            </div>
                                        </form>
                                        <form action="sign_in.php" Method="POST">
                                            <div id="details">
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small" style="color:maroon;">
                                            <a href="createAccount.php" style="color:maroon;"> Already Verified and Paid(for UTME)? (Create User Account Here) Or Sign up! &nbsp; &nbsp; &nbsp;</a> || &nbsp; &nbsp; &nbsp;
                                            <a href="https://eportal.escohsti-edu.ng/" style="color:maroon;"> >> Return To Portal Home</a>
                                        </div>
                                        <div class="small" style="color:maroon;">
                                            <a href="login.php" style="color:maroon;">Already Screened (for UTME)? (Check Admission Status) Or Sign up! &nbsp; &nbsp; &nbsp;</a> || &nbsp; &nbsp; &nbsp;
                                            <a href="https://eportal.escohsti-edu.ng/" style="color:maroon;"> >> Return To Portal Home</a>
                                        </div>
                                    </div>
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
        <script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});

</script>
         <script type="text/javascript">
            $(document).ready( function(){
                
         $('#jambform').submit(function(e){
                    e.preventDefault()
                    var regnum = $("#regnum").val();
                    var info = $("#info");
        info.html('<div class="loading-indicator"><span><img src="https://applications.escohsti-edu.ng/images/load.gif" width="40" height="40"/></span><p>Loading...</p></div>');
                $("#submit").prop('disabled', true);
                      
        $.ajax({   
                            url:"/reg_num_verify.php?regnum="+regnum,
                            type: 'POST',
                            dataType: 'json',
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
                                $("#response").html(response.message+', Please wait...');
                               // alert("Deposit Placed");
                                /*Swal.fire({
                                title: "Success!",
                                text: "Success. "+response,
                                type: "success",
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                                });*/
                                console.log(response.userdata.name);
                                let userdata = response.userdata;
                                let status = response.error;
                                setTimeout(function(){ 
                                    $("#regnum").prop('readonly', true);
                                    $("#regnum").hide();utj
                                    $("#utj").hide();
                                    var regnum = '<div class="form-group"><label class="small mb-1" for="regnum">Jamb Reg No: &nbsp; </label><input readonly class="form-control py-4" type="text"value="'+response.userdata.regno+'" placeholder="regnum" name="regnum"  required /></div>';
                                    var name = '<div class="form-group"><label class="small mb-1" for="name">Name: &nbsp; </label><input readonly class="form-control py-4" type="text"value="'+response.userdata.name+'" placeholder="Name" name="name"  required /></div>';
                                    var phone = '<div class="form-group"><label class="small mb-1" for="phone">Phone: &nbsp; </label><input readonly class="form-control py-4" type="text"value="'+response.userdata.phone+'" placeholder="Name" name="phone"  required /></div>';
                                    var email =  '<div class="form-group"><label class="small mb-1" for="Email">Email: (Note: Make sure to use your email address. Do not use cybercafe\'s email address as this may cause disqualification of application.) &nbsp; </label><input class="form-control py-4" type="email" placeholder="Email" id="email"name="email"  required /></div>';
                                    var sex = '<div class="form-group"><label class="small mb-1" for="sex">Sex: &nbsp; </label><input readonly class="form-control py-4" type="text"value="'+response.userdata.sex+'" placeholder="Name" name="sex"  required /></div>';
                                    var score = '<div class="form-group"><label class="small mb-1" for="score">Score: &nbsp; </label><input readonly class="form-control py-4" type="text"value="'+response.userdata.score+'" placeholder="Name" name="score"  required /></div>';
                                    var address = '<div class="form-group"><label class="small mb-1" for="address">Address: &nbsp; </label><input readonly class="form-control py-4" type="text"value="'+response.userdata.lga+', '+response.userdata.state+'" placeholder="Name" name="address"  required /></div>';
                                    var sub = '<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><button class="btn btn-primary"  name="proceed" type="submit">Proceed to Payment</button></div>';
                                    $("#response").html('');
                                    $("#details").html(regnum+name+email+phone+sex+score+address+sub);
                                    $("#submit").prop('disabled', false);
                                    $("#submit").hide();
                                    info.html('');
                                }, 10000);
                                if(status === true){
                                    setTimeout(function() { 
                                    window.location.href = "/";
                                    location.reload();
                                    }, 5000);
                                }
                                /*if (userdata.length != 0) {
                                    
                                    
                                }
                                if(status === true){
                                    setTimeout(function() { 
                                    window.location.href = "/gdgdgg.php";
                                    
                                    }, 10000);
                                }else if(status === false){
                                    setTimeout(function() { 
                                    window.location.href = "/";
                                    location.reload();
                                    }, 10000);
                                }*/
                            
                            } 
                        });
         })          
    });
                        
       </script>
      
    </body>
</html>
