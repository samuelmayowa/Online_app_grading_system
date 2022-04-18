<?php
include_once('functions.php');
require_once('connection.php');

$adminContact="";
 $refNum ="";
$adminContact = "Mail : admin@escohsti-edu.ng <br />
                    FOR ENQUIRY PLEASE CONTACT: 08130925149 OR 08038143003";
   $stdPhno="";  
   $stdEmail="";
   $stats="";
$user ="";
$appMsg="";
$id="";

if(!isset($_SESSION['user'])){
    header('location:login.php?msg=Login In To Proceeds');
}

if(isset($_GET['user']) && isset($_GET['stats'])){
    echo $msg="<script> alert('You Cannot Geneate Another Invoice for this Service (2021/2022 Application Form) ');</script>";
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
         
         $msg ="You Have Paid On Your Invoice";
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
    $refNum ="";
     $user= $_GET['user'];
if($payID = mysqli_query($con,"SELECT FirstName, Surname, RefNum, RegNumber, PhoneNO, Email,Departments,Acceptance FROM onlineApplications WHERE Username ='$user'")){
    while($pID = mysqli_fetch_array($payID)){
         $refNum = $pID ['RefNum'];
         $regNum = $pID ['RegNumber'];
         $stdPhno = $pID ['PhoneNO'];
         $stdEmail = $pID ['Email'];
         $dpt= $pID ['Departments'];
         $stats= $pID ['Acceptance'];
         $fname= $pID ['FirstName'];
         $lname= $pID ['Surname'];
         $_SESSION['fname']=$fname;
         $_SESSION['lname']=$lname;
         $_SESSION['sts']=$stats;
          $_SESSION['dpt']=$dpt;
         $_SESSION['stdEmail']=$stdEmail;
         $_SESSION['stdPhno'] = $stdPhno;
         $_SESSION['refNum'] = $refNum;
         $_SESSION['regNum'] = $regNum;
         $msg ="You Have Paid On Your Invoice";
    }
}
}

// Get Admission Status
$admStatus="";
// echo "<script>alert('$regNum'); </script>";
if(isset($_GET['user'])){
     $user=$_GET['user'];
 $query1 = mysqli_query($con, "SELECT * FROM admissions Where RegNumber ='$regNum'");
 while($row=mysqli_fetch_array($query1)){
     $admStatus= $row['AdmStatus'];
     
 }
//  echo $admStatus;
//  echo "<script>alert('$admStatus'); </script>";
 }

$checkApps="";
$user=$_GET['user'];
$checkApps=getAppx($con,$user);
//echo "<script> alert('$regNum');</script>";
//echo "<script> alert('$checkApps');</script>";
if($checkApps=="" &&  $regNum==""){
    $appMsg="<script> alert('You have not Completed Your Application, Please Complete Application Form All at Once');</script>";
}elseif($checkApps == $regNum) {
    $appMsg="<script> alert('You have Completed Your Apps');</script>";
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
        
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Welcome To User Application Dashboard  
                                    <img  id="ig" src="<?php if(isset($file_path)){
                                                     echo  $file_path;  } else { echo 'passports/profiles.jpg'; }?>" alt="Avatar" style="width:10%" align="center" ></h3><span style="color:red;" ><?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?></span></div>
                                    <div class="card-body">
                                        <span style="color:green;"><?php if(isset($msg)) { echo $msg. ': ' . $refNum; }  ?> <br /> <?php if(isset($appMsg)) { echo $appMsg; } ?></span>
                                        
                                        <div class="form-row">
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <div class="small"><a href="invoice_copy.php?user=<?php if(!empty($user)) { echo $user; } ?> && refNum=<?php if(!empty($refNum)) { echo $refNum; } ?>" class="btn btn-primary btn-block">Generate 2020/2021 Application Form & Invoice</a></div>
                                                       
                                                    </div>
                                                </div>
                                                <!--<div class="form-row">-->
                                                <?php 
                                                
                                                if($admStatus == 1){
                                      
                                                echo '<div class="col-md-6">
                                                    <div class="form-group">
                                                      <div class="small"><a href="acceptance/payments.php?refNum=<?php if(!empty($refNum)) { echo $refNum; } ?>" class="btn btn-primary btn-block">Pay (Acceptance Fees)</a></div>
                                                       
                                                    </div>
                                                </div>
                                                </div>';
                                                }else {
                                                    echo '<div class="col-md-6">
                                                    <div class="form-group">
                                                      <div class="small"><a href="#acceptance/payments.php?refNum=<?php if(!empty($refNum)) { echo $refNum; } ?>" class="btn btn-primary btn-block" style="background-color:maroon; color:lavender;">Application Received and Screening Under Processing</a></div>
                                                       
                                                    </div>
                                                </div>
                                                </div>';
                                                } 
                                                
                                                
                                                ?>
                                                 
                                         <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                       <div class="small"><a href="photoCard.php?user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary btn-block">Print PhotoCard</a></div>
                                                    </div>
                                                </div>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <div class="small"><a href="#receipts.php?refNum=<?php if(!empty($refNum)) { echo $refNum; } ?>" class="btn btn-primary btn-block">Reprint Receipts</a></div>
                                                       
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                       <div class="small"><a href="myAdmission.php?regNum=<?php if(!empty($regNum)) { echo $regNum; } ?> &&  user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary btn-block">Check Admission Status</a></div>
                                                    </div>
                                                </div>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <div class="small"><a href="myResults.php?refNum=<?php if(!empty($regNum)) { echo $regNum; } ?>  && user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary btn-block">Check My Results</a></div>
                                                       
                                                    </div>
                                                </div>
                                                </div>
                                    </div>
                                        
                                        
                                        
                                    <div class="card-footer text-center">
                                        <?php echo $adminContact; ?>
                                        <div class="small"><a href="logout.php" class="btn btn-primary btn-block"> >>Logout</a></div>
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
