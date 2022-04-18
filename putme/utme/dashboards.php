<?php
include_once('../functions.php');
require_once('../connection.php');

$adminContact="";
 $refNum ="";
 $acpt="";
 $loggedin="";
 $admStatus="";
 $rsStatus="";
$adminContact = "Mail : admin@escohsti-edu.ng <br />
                    FOR ENQUIRY PLEASE CONTACT: 08130925149 OR 08038143003";
   $stdPhno="";  
   $stdEmail="";
   $stats="";
$user ="";
$appMsg="";
$id="";
$notif="";
$admStatus="";

if(!isset($_SESSION['user'])){
    header('location:login.php?msg=Login In To Proceeds');
}
if(isset($_SESSION['user'])){
    $loggedin =$_SESSION['user'];
    
    }
if(isset($_GET['user']) && isset($_GET['stats'])){
    $msg="<script> alert('You Cannot Geneate Another Invoice for this Service (2021/2022 Application Form) ');</script>";
}

if(isset($_GET['user'])){
    $user= $_GET['user'];
  $qry=mysqli_query($con, "Select ID From userAccounts Where Username='$user'") or $msg=die(mysqli_error($con));
     while($stID=mysqli_fetch_array($qry)){
         $id=$stID['ID'];
     }
    //  echo "<script>alert('$id');</script>";
if($payID = mysqli_query($con,"SELECT RefNum,Status FROM onlineApplications WHERE Username ='$user'")){
    while($pID = mysqli_fetch_array($payID)){
         $refNum = $pID ['RefNum'];
         $stats = $pID ['Status'];
         $_SESSION['refNum'] = $refNum;
         
         $msg ="You Have Paid. Your Invoice RRR: ".$refNum;
    }
}
}

 if(isset($_GET['user'])){
     $user= $_GET['user']; 
     $file_path ="";
$filelocation="";
    
    $query = "SELECT  photograph FROM onlineApplications WHERE username ='$user'";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
    while ($results  = mysqli_fetch_array($query)){
       $file_path =  $results ['photograph'];
      // $_SESSION['file_loc'] = $file_path;
        $_SESSION['file_path'] =$file_path;
       
        
    }
 } elseif(empty($_GET['user'])){
     header('location:login.php?msg=You Must Login To Continue');
 }
 
 
   $regNum="";
     if(isset($_GET['user'])){
    
     $user= $_GET['user'];
if($payID = mysqli_query($con,"SELECT * FROM onlineApplications  WHERE Username ='$user'")){
    while($pID = mysqli_fetch_array($payID)){
         $refNum = $pID ['RefNum'];
         $regNum = $pID ['RegNumber'];
         $stdPhno = $pID ['PhoneNO'];
         $user1= $pID ['Username'];
         $stdEmail = $pID ['Email'];
         $dpt= $pID ['Departments'];
         $acpt= $pID ['Acceptance'];
         $fname= $pID ['FirstName'];
         $lname= $pID ['Surname'];
          $admStatus= $pID['AdmStatus'];
         $_SESSION['fname']=$fname;
         $_SESSION['lname']=$lname;
         $_SESSION['sts']=$acpt;
          $_SESSION['dpt']=$dpt;
         $_SESSION['stdEmail']=$stdEmail;
         $_SESSION['stdPhno'] = $stdPhno;
         $_SESSION['refNum'] = $refNum;
         $_SESSION['regNum'] = $regNum;
         $msg ="You Have Paid. Your Invoice No: ";
    }
}
}

// Get Admission Status
//$admStatus="";
//echo "<script>alert('Welcome Back!:  ($user) Application Status : '+ '$stats'); </script>";
/*if(isset($_GET['user'])){
     $user=$_GET['user'];
     $regNum=$_SESSION['regNum'];
 $query1 = mysqli_query($con, "SELECT * FROM admissions Where RegNumber ='$regNum'");
 while($row=mysqli_fetch_array($query1)){
     $admStatus= $row['AdmStatus'];
     
 }*/
//  echo $admStatus;
//  echo "<script>alert('$admStatus'); </script>";
// }

if(isset($_GET['user'])==$loggedin && $acpt == 0){
 $query=mysqli_query($con, "Select * From Invoices Where StudentID='$id' AND InvoiceStatus='Successful' AND ServiceType='2021/2022 Acceptance Fee'");
 if($ref=mysqli_num_rows($query)  ==1){
     echo  "<script> alert('$ref ' + ' Acceptance Fee Updated');</script>";
     $query=mysqli_query($con, "UPDATE onlineApplications SET Acceptance ='1' Where Username='$loggedin'");
 }
}

$checkApps="";
$user=$_GET['user'];
$checkApps=getAppx($con,$user);
//echo "<script> alert('$regNum');</script>";
//echo "<script> alert('$checkApps');</script>";
if($checkApps=="" &&  $regNum==""){
    $appMsg="<script> alert('You have not Completed Your Application, Please Complete Application Form All at Once');</script>";
}elseif($checkApps == $regNum && $stats == 3) {
    $mg='You Are Advised to Reprint Your PhotoCard For Your Examination Date';
    $appMsg="<script> alert('You have Completed Your Apps, '+ ' $mg');</script>";
    /*$appMsg='<script>
         var str = new String("You have Completed Your Apps " + "You Are Advised to Reprint Your PhotoCard For Your Examination Date");
         
         alert(str.fontcolor( "blue" ));
      </script>';*/
}

//$result_check=checkResults($con,$regNum);
//echo "<script> window.alert('$result_check');</script>";
$dfaulti_img="https://i.pinimg.com/originals/43/96/61/439661dcc0d410d476d6d421b1812540.jpg";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero Ekiti" />
        <meta name="author" content="" />
        <title>Application-Student Portal</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        label{font-size:24px; padding:10px; font-family:Arial Black; }
            #ig {
                  border-radius: 50%;
                  border:2px solid grey;
                }
        
        
     /*.image_inner_container{*/
     /*  	border-radius: 50%;*/
     /*  	padding: 5px;*/
     /*   background: #833ab4; */
     /*   background: -webkit-linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4); */
     /*   background: linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4);*/
     /*  }*/
       .image_inner_container img{
       	height: 80px;
       	width: 80px;
       	border-radius: 50%;
       	border: 5px solid white;
       }
       .container{
       	height: 100%;
       	align-content: center;
       }

       /*.image_outer_container{*/
       /*	margin-top: auto;*/
       /*	margin-bottom: auto;*/
       /*	border-radius: 50%;*/
       /*	position: relative;*/
       /*}*/
       h3{
           color:maroon;
       }
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
<h3  class="text-center font-weight-light my-4"> Revalidate Your ACCEPTANCE Receipt Payment RRR to Print Receipt</h3>
<hr>
<p data-bracket-id="23">
     Latest Updates: <br>
    <h5></h5><code> This is to Inform All Prospective Applicants/Candidate Who have generated / Paid For 2021/2022 ACCEPTANCE FEES to VALIDATE Your Acceptance Fee Payment  RRRR,<br>  So as to enable you print Receipt For 2021/2022 Acceptance Fee Payment. <br>
    For This is a Fundamental requirement for the Admission Process and Registration</code></h5><br>
     <h4>Follow The Simple Steps Below:</h4>
    1. Click on Pay Acceptance Link Button<br>
    2. Scroll Down the page and click on Validate RRR <br>
    3. Enter Your RRR Number <br>
    4. Click on Validate Button.<br>
    5. Wait for Few Seconds as Instructed by the system to Validate your RRR <br>
    6. You are automatically Redirected to the Receipt Print Out and <br>
    7. Click on Print Button below to print the Receipt.<br>
     Viola !! Your are Done! <br>
    Congratulations<br>
     
     return to your dashbaord 
     <br>
     
    <?php if(isset($_GET['adm'])){ echo $_GET['adm'] . "<code> Ensure you pay Your Acceptance Before Printing Admission Letter to Accept Your Admission</code>"; } ?>
    Latest Updates: <br>
    <h5></h5><code> Ensure you pay Your Acceptance Before Printing Admission Letter to Accept Your Admission.</code></h5><br>
    All Applicants are Required to print the admission Notification and Proceeds to pay their Acceptance Fees.<br>
    <?php if(isset($_GET['adm'])){ echo $_GET['adm'] . "<code> Ensure you pay Your Acceptance Before Printing Admission Letter to Accept Your Admission</code>"; } ?>
<?php  //echo getNws($con);  ?>    
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
                <?php include('topbar.php'); ?>
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></h3></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Welcome To User Application Dashboard  
                                    </h3><span style="color:red;" ><?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?></span></div>
                                            <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="color:yellow; font-size:24px; font-family:Comic Sans MS;">
                                     CLICK HERE to Get Examination Notification
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ESCOHST-IJERO Examination  Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h3 class="text-center font-weight-light my-4">If Your Photocard is Not Showing Your Passport with The Exam Date, You WIll Not be Allowed to the Examination Hall.</h3>
       <h3 class="text-center font-weight-light my-4">Exam Date is Scheduled to :Available Later <!--September 30th, 2021.--></h3>
       <h3 class="text-center font-weight-light my-4">Time is Not Available Now, Check Later <!--8:00 -->am Prompt.</h3>
       <h3 class="text-center font-weight-light my-4">Ensure you reprint your Photocard To Have the Exam Date on Your photocard.</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"><div class="small"><a href="photoCard.php?user=<?php echo $_SESSION['user'];  ?>" class="btn btn-primary btn-block">Re-Print PhotoCard</a></div></button>
      </div>
    </div>
  </div>
</div>
                                    <div class="card-body">
                                        <span style="color:green;"><?php if(isset($msg)) { echo $msg. ': ' . $refNum; }  ?> <br /> <?php if(isset($appMsg)) { echo $appMsg; } ?></span>
                             
                                        <div class="form-row">
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                       <?php 
                                                      if($stats != 3){  ?>
                                                      <div class="small"><a href="invoice.php?user=<?php if(!empty($user)) { echo $user; } ?> && refNum=<?php if(!empty($refNum)) { echo $refNum; } ?>" class="btn btn-primary btn-block">Generate 2021/2021 Application Form & Invoice</a></div>
                                                      <?php } else { ?>
                                                       <div class="small"><a href="invoice.php?user=<?php if(!empty($user)) { echo $user; } ?> && refNum=<?php if(!empty($refNum)) { echo $refNum; } ?>" class="btn btn-primary btn-block">You Have Successfully Generated 2021/2022 Online Application Form</a></div>
                                                      <?php  }?>
                                                    </div>
                                                </div>
                                                <!--<div class="form-row">-->
                                                <?php 
                                                $issAccpted=checkisacceptgenerated($con,$user1);
                                                //echo "<script> alert('$issAccpted');</script>";
                                                if(empty($issAccpted)){
                                                if($admStatus == 1){ ?>
                                      
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <div class="small"><a href="acceptance.php?user=<?php echo $_SESSION['user'];  ?>" class="btn btn-primary btn-block">Pay (Acceptance Fees)</a></div>
                                                       
                                                    </div>
                                                </div>
                                                
                                                <?php }else { ?>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                      <div class="small"><a href="#" class="btn btn-primary btn-block">Only Admitted Candidate Can Pay Acceptance Fees</a></div>
                                                       
                                                    </div>
                                                </div>
                                                
                                                <?php } }else{
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <div class="small"><a href="https://applications.escohsti-edu.ng/manual-rrr-acp.php" class="btn btn-primary btn-block">Valiate ACCEPTANCE FEE  Fees</a></div>
                                                       
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                </div>
                                                
                                                
                                                 
                                         <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                         <?php 
                                                      if($stats != 3){ ?>
                                                          <div class="small"><a href="#photoCard.php?user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary btn-block">Only Completed Application Can Reprint Photo Card</a></div>
                                                            <?php } else { ?>
                                                           <div class="small"><a href="photoCard.php?user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary btn-block">Print PhotoCard</a></div>
                                                            <?php } ?>
                                                       
                                                    </div>
                                                </div>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                     <div class="small"><a href="Re_print_success_invoice.php?refNum=<?php if(!empty($refNum)) { echo $refNum; } ?>" class="btn btn-primary btn-block">Reprint Receipts For Application Form</a></div>
                                                    
                                                       
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    
                                                    <div class="form-group">
                                                      <?php 
                                                
                                                $is_admission=checkadmission($con,$regNum);
                                                if($is_admission == $regNum && $acpt ==1){ ?>
                                                  <!-- // if($acpt ==1)-->
                                                       <div class="small"><a href="myAdmission.php?regNum=<?php if(!empty($regNum)) { echo $regNum; } ?> &&  user=<?php echo $user; ?>" class="btn btn-primary btn-block">Check Admission Status</a></div>
                                                    </div>
                                                </div>
                                                <?php } else{ ?> 
                                                    <div class="small"><a href="#myAdmission.php?regNum=<?php if(!empty($regNum)) { echo $regNum; } ?> &&  user=<?php echo $user; ?>" class="btn btn-primary btn-block">Only Successful Candidate Can Check Admission Status</a></div>
                                                    </div>
                                                </div>
                                               <?php  }
                                                ?>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php 
                                                $result_check=checkResults($con,$regNum);
                                                if(!empty($result_check)){
                                                if($result_check ==  $regNum){ ?>
                                                      <div class="small"><a href="resultcheck.php" class="btn btn-primary btn-block">Check My Results</a></div>
                                                        <?php } else{ ?> 
                                                        <div class="small"><a href="#resultcheck.php" class="btn btn-primary btn-block">Results Checker Not Available</a></div>
                                                         <?php  }} else{ 
                                                          ?>
                                                        <div class="small"><a href="#resultcheck.php" class="btn btn-primary btn-block">Results Checker Not Available</a></div>
                                                      <?php  } ?>
                                                    </div>
                                                </div>
                                                </div>
                                    
                                    <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <?php 
                                                
                                                if($admStatus == 1 && $acpt ==1){ ?>
                                                       <div class="small"><a href="print_success_accept.php?regNum=<?php if(!empty($regNum)) { echo $regNum; } ?> &&  user=<?php echo $user; ?>" class="btn btn-primary btn-block">Reprint Acceptance Slip</a></div>
                                                    </div>
                                                </div>
                                                <?php } else{ ?> 
                                                    <div class="small"><a href="#myAdmission.php?regNum=<?php if(!empty($regNum)) { echo $regNum; } ?> &&  user=<?php echo $user; ?>" class="btn btn-primary btn-block">Only Candidate Who Accept Admission Can Reprint Acceptance Slip</a></div>
                                                    </div>
                                                </div>
                                               <?php  }
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php 
                                                
                                                if($admStatus == 1){ ?>
                                                      <div class="small"><a href="resultcheck.php" class="btn btn-primary btn-block"> Visit Admission Office to Buy Scratch Pin</a></div>
                                                        <?php } else{ ?> 
                                                        <div class="small"><a href="#resultcheck.php" class="btn btn-primary btn-block">Only Successful candidate Can Get Scratch Card</a></div>
                                                         <?php  } ?>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <?php 
                                                      $result_check=checkResults($con,$regNum);
                                                    $is_admission=checkadmission($con,$regNum);
                                                if($result_check ===  $regNum && $is_admission == $regNum){ ?>
                                                       <div class="small"><a href="#https://applications.escohsti-edu.ng/admissions/ChangeCourse.docx"  class="btn btn-primary btn-block">Print Change Of Course Form</a></div>
                                                    </div>
                                                </div>
                                                <?php } ?> 
                                                   
                                              
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <?php 
                                                      $result_check=checkResults($con,$regNum);
                                                     $is_admission=checkadmission($con,$regNum);
                                                if(!empty($result_check)){
                                                if($result_check ==  $regNum  && $is_admission == $regNum) { ?>
                                                       <div class="small"><a href="https://applications.escohsti-edu.ng/admissions/notifications.php?regNum=<?php if(!empty($regNum)) { echo $regNum; } ?> &&  user=<?php echo $user; ?>"  class="btn btn-primary btn-block">Print Notification </a></div>
                                                    
                                                <?php  } }
                                                
                                                  else{ 
                                                          ?>
                                                          
                                               <div class="small"><a href="https://applications.escohsti-edu.ng/admissions/notifications.php?regNum=<?php if(!empty($regNum)) { echo $regNum; } ?> &&  user=<?php echo $user; ?>"  class="btn btn-primary btn-block">Admission Notification Not Available</a></div>
                                                     <?php  } ?>
                                                    </div>
                                                    </div>
                                    </div>
                                     <div class="form-row">
                                     <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                                
                                                $is_admission=checkadmission($con,$regNum);
                                                if($is_admission == $regNum && $acpt ==1){ ?>
                                    <div class="small"><a href="admissions/admLetter.php?msg=<?php echo $_SESSION['regNum']; ?>"><button  type="button" name="printAdmLetter" class="btn btn-primary btn-block"  >Print Admission Letter</button></a></div>
                                        <?php } ?>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                                
                                                $is_admission=checkadmission($con,$regNum);
                                                if($is_admission == $regNum && $acpt ==1){ ?>
                                    <div class="small"><a href="payComp.php?msg=<?php echo $_SESSION['regNum']; ?>"><button  type="button" name="compulsory" class="btn btn-primary btn-block"  >Pay Compulsory Fees (#85,000)</button></a></div>
                                        <?php } ?>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="card-footer text-center">
                                        <?php echo $adminContact; ?>
                                        <div class="small"><a href="https://applications.escohsti-edu.ng/logout.php" class="btn btn-primary btn-block"> >>Logout</a></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </main>
           </div>
            <div id="layoutAuthentication_footer">
               <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti. 2021-2022</div>
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
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
    </body>
</html>
