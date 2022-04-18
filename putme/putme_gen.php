<?php
include_once('functions.php');
require_once('connection.php');
if(isset($_GET['user'])){
    $regnum = $_GET['user'];
    $email = $_GET['email'];
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
}else{
    header("location:sign_in.php"); 
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
                                        <form action="putme_invoice.php" Method="POST" id="jambform">
                                          
                                    <div class="form-group"><label class="small mb-1" for="regnum">Jamb Reg No: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $regno?>" placeholder="regnum" name="regnum"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="name">Name: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $name?>" placeholder="Name" name="name"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="Email">Email: (Note: Make sure to use your email address. Do not use cybercafe's email address as this may cause disqualification of application.) &nbsp; </label><input readonly class="form-control py-4" value="<?php echo $email?>" type="text" placeholder="Email" id="email"name="email"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="phone">Phone: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $phone?>" placeholder="Phone" name="phone"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="sex">Sex: &nbsp; </label><input readonly class="form-control py-4" type="text"value="<?php echo $sex?>" placeholder="Name" name="sex"  required /></div>
                                    <div class="form-group"><label class="small mb-1" for="score">Amount: &nbsp; </label><input readonly class="form-control py-4" type="text"value="#2000" placeholder="Amount" name="amount"  required /></div>
                                    <input class="form-control py-4" type="hidden" id="rrr_value" value="" name="rrr_value" />
                                    <input class="form-control py-4" type="hidden" id="rrr_status" value="" name="rrr_status" />
                                    <input class="form-control py-4" type="hidden" id="rrr_statuscode" value="" name="rrr_statuscode" />
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><button class="btn btn-primary"  name="invoice" type="submit">Generate RRR</button></div>
                                  
                                </form>
                                        
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small" style="color:maroon;">
                                            <a href="#" style="color:maroon;"> Already Verified and Paid(for UTME)? (Create User Account Here) Or Sign up! &nbsp; &nbsp; &nbsp;</a> || &nbsp; &nbsp; &nbsp;
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
        <input type="hidden" id="user_email" value="<?php echo $email?>">
        <input type="hidden" id="user_reg" value="<?php echo $regno?>">
        <script>
        var email = $("#user_email").val();
         var user_reg = $("#user_reg").val();
            function clickButton() {
              var s = document.createElement("script");
              s.src = "rrr-generate-putme.php?user="+user_reg+"&email="+email;
              document.body.appendChild(s);
            }
            var s = document.createElement("script");
              s.src = "rrr-generate-putme.php?user="+user_reg+"&email="+email;
              document.body.appendChild(s);
            
            function jsonp (ReturnedValue) {
             document.getElementById("rrr_value").innerHTML = ReturnedValue.RRR;
              document.getElementById("rrr_status").innerHTML = ReturnedValue.status;
              document.getElementById("rrr_statuscode").innerHTML = ReturnedValue.statuscode;
              $('#rrr_value').val(ReturnedValue.RRR);
              $('#rrr_status').val(ReturnedValue.status);
              $('#rrr_statuscode').val(ReturnedValue.statuscode);
            }
        </script>
        
    </body>
</html>
