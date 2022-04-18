<?php
include 'functions.php';
    if(isset($_GET['reg'])){
        $regnum = $_GET['reg'];
        $query = mysqli_query($con, "SELECT * From jamb_data Where RG_NUM ='$regnum'");
    	if($query){
    	    $usr =mysqli_num_rows($query) ;
    	  if(!empty($usr)){
    	      while($user=mysqli_fetch_array($query)){
    	          $refNNum=$user['RRR'];
    	      }
    	  }
    	}else{
            header("location:sign_in.php"); 
        }
        $sha_value =  $orderID = $apiKey = "";
        $seletFromID = 2;
        $MerchantID = apiCredential($seletFromID, 'MerchantID');
        //$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
        $ser_id = 5;
        $ServiceTypeID = ServiceTypeID($ser_id, 'Value');
        $ApiKey = apiCredential($seletFromID, 'ApiKey');
        $ApiKey = apiCredential($seletFromID, 'ApiKey');
        
        
        $hash_value =hash("sha512",$MerchantID.$refNNum.$ApiKey);
            
        $responseUrl = 'https://'.$_SERVER['SERVER_NAME'].'/response_putme.php';
           
    }else{
       header("location:sign_in.php?user={$regnum}"); 
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
                                        <div class="card-header"><h6 class="text-center font-weight-light my-4" style="color:#23c745; font-family:Arial Black;"> Make Payment</h6></div>
                                        <form action="https://login.remita.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" method="POST">
                                        

                                            <input name="merchantId" value="<?php echo $MerchantID; ?>" type="hidden">
                                            
                                            <!--<input name="merchantId" value="2547916" type="hidden">-->
                                            
                                            <input name="hash" value="<?php echo $hash_value; ?>" type="hidden">
                                            
                                            <!--<input name="hash" value="4f33dc2478836218506a12b4bb512f711eaadbf9ea521ba443a8da1bd233bf234c6f62d23b91675db2467aa2586e3d5f49e37cd594361c0938f30349410282cb"type="hidden">-->
                                            
                                            <input name="rrr" value="<?php echo $refNNum; ?>" type="hidden">
                                            
                                            <!--<input name="rrr" value="280008217946" type="hidden">-->
                                            
                                            <input name="responseurl" value="<?php echo $responseUrl; ?>" type="hidden">
                                            
                                            <!--<input name="responseurl" value="http://www.startuppackng.com/response.php" type="hidden">-->
                                            
                                            
                                            <div class="card-header"><h3 class="text-center font-weight-light my-4"><input type ="submit" class="btn btn-primary" name="submit_btn" value="Pay Via Remita"> </h3></div>
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

                  