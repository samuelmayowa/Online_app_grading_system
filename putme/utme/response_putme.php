<?php
session_start();
include 'functions.php';
   //SHA512 (rrr/orderId+api_key+merchantId)
if(isset($_GET['RRR']) && isset($_GET['orderID'])){
    
    $rrrget = $_GET['RRR'];
    $orderIDget = $_GET['orderID'];
    $regnum= $_SEESION['regnum'] ;
    if(!$regnum){
        $query = mysqli_query($con, "SELECT * From jamb_data Where RRR ='$rrrget'");
    	if($query){
    	    $usr =mysqli_num_rows($query) ;
    	  if(!empty($usr)){
    	      while($user=mysqli_fetch_array($query)){
    	          $id=$user['id'];
    	          $regnum=$user['RG_NUM'];
    	          $orderID =$user['order_id'];
    	          $refNNum=$user['RRR'];
    	          $name = $user['RG_CANDNAME'];
    	          $sex = $user['RG_SEX'];
    	          $state = $user['STATE_NAME'];
    	          $score = $user['RG_AGGREGATE'];
    	          $lga = $user['LGA_NAME'];
    	          $phone = $user['PHONE NUMBER'];
    	      }
    	  }
    	}
    }
    //$hash_value =hash("sha512",$rrr.'/'.$orderID.$ApiKey.$MerchantID);
    /*echo $transactions='<table>
                    <tr><td>RRR</td><td>Action</td><td> Order ID</td></tr>
                    <tr><td>'.$rrr.'</td>
                    <td><form method ="GET" action="https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/'.$MerchantID.'/'.$orderID.'/'.$hash_value.'/orderstatus.reg"><button>Get Status</button></form></td><td>'.$orderID.'</tr>
                    </table>';*/
}elseif(isset($_GET['RRR']) && isset($_GET['status']) && isset($_GET['statuscode'])){
    $rrrget = $_GET['RRR'];
    $statusget = $_GET['status'];
    $statuscodeget = $_GET['statuscode'];
    $regnum= $_SEESION['regnum'] ;
    if(!$regnum){
        $query = mysqli_query($con, "SELECT * From jamb_data Where RRR ='$rrrget'");
    	if($query){
    	    $usr =mysqli_num_rows($query) ;
    	  if(!empty($usr)){
    	      while($user=mysqli_fetch_array($query)){
    	          $id=$user['id'];
    	          $regnum=$user['RG_NUM'];
    	          $orderID =$user['order_id'];
    	          $refNNum=$user['RRR'];
    	          $name = $user['RG_CANDNAME'];
    	          $sex = $user['RG_SEX'];
    	          $state = $user['STATE_NAME'];
    	          $score = $user['RG_AGGREGATE'];
    	          $lga = $user['LGA_NAME'];
    	          $phone = $user['PHONE NUMBER'];
    	      }
    	  }
    	}
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
                                        <p id="response"></p>
                                        
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
      
         <?php if(!empty($rrrget) && !empty($orderIDget)){ ?>
        
       <script>
        $.ajax({   
                            url:"/rrr-paymentstatus-putme.php?user=<?php echo $regnum; ?>&rrr=<?php echo $rrrget;?>&orderId=<?php echo $orderIDget; ?>",
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
                                
                                
                            setTimeout(function() { 
                             window.location.href = "/print_success_putme.php";
                            }, 10000);
                            } 
                        });
                        
       </script>
       
       <?php } elseif(!empty($rrrget) && !empty($statusget) && !empty($statuscodeget)){ ?>
       <script>
        $.ajax({   
                   url:"/rrr-paymentstatus-putme.php?user=<?php echo $regnum; ?>&rrr=<?php echo $rrrget; ?>&statusGet=<?php echo $statusget; ?>&statusCodeGet=<?php echo $statuscodeget; ?>",
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
                                
                            setTimeout(function() { 
                            window.location.href = "/print_success_putme.php?regnum=<?php echo $regnum; ?>";
                            }, 10000);
                            } 
                        });
                        
       </script>
       <?php }?>
    </body>
</html>

                  