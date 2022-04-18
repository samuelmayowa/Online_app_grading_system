<?php

include_once('functions.php');
require_once('connection.php');
$payID="";
if(!isset($_SESSION['user'])){
  header("location:index.php?msg=You have not logged in") ;
} else {
if(isset($_GET['payID'])){
$screenData = filter_var_array($_GET, FILTER_SANITIZE_STRING);
$payID =$screenData['payID'];   
$paidFor=$_SESSION['payingFor'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$midName=$_SESSION['midName'];
$user=$_SESSION['user'];
$amount = $_SESSION['amount'];
$email=$_SESSION['email'];
$phno =  $_SESSION['phno'];
$_SESSION['payID'] =$payID;
$upd ="<script>alert('Your Payment Was Successully Made to The Admin Your RefNumber:  ');</script>"; 
   
        /* $addpayment = "INSERT INTO studentPayments (CourseCode, MatricID, payType, 
        AmountPaid,RefNumber,  StdLevel, Semester,Amountpayable, studentEmail) 
 VALUES ('$courseCode', '$matricNumber', '$payType', '$amount','$payID', '$stdLevel', '$semester','$amount', '$email' )";
 */
 $lname=$midName .'  '. $lname;
 $addpayment = "INSERT INTO ApplicantsPayments (RefNum,FirstName, Surname,  Username, PhoneNumber , 
        AmountPaid, Email,PaidFor) 
 VALUES ('$payID', '$fname', '$lname', '$user', '$phno','$amount', '$email','$paidFor' )";
 
  $query = "SELECT RefNumber  FROM studentPayments WHERE RefNumber ='$payID'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

            if($CCode ==0){
        // ========End check ====== 
          $addpayment = mysqli_query($con,$addpayment) or $msg=mysqli_error($con);
          /*$addpayment2 = mysqli_query($con,$addpayment) or die(mysqli_error($con));*/
         if(!$addpayment ){
             $msg="Unable to Add Payment Details To Database".mysqli_error($con);
             $msg ="<script>alert('$msg');</script>";
         }else { 
            //  header('location:applications.php?payID='.$payID. ' && msg=Your Payment Was Successully Made to The Admin');
             echo $msg ="<script>alert('Your Payment Was Successully Made to The Admin');</script>";
            
         }
   
    }
    else{
        $msg = "<script> alert('1 Payments Already Exist'); </script>";
                }
}
}
$stdMail=$_SESSION['email'];
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
                        <a class="dropdown-item" href="myProfiles.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="UserdashBoard.php?user=<?php echo $user; ?>">Dashboard</a>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology, Ijero-Ekiti</h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Application Process</h3></div>
                                     <div class="card-header"><h3 class="text-center font-weight-light my-4">
                                     <!--<img src="<?php//if(isset($file_path)){
                                                     //echo  $file_path;  } else { echo 'passports/profiles-01.jpg'; }?>" alt="Avatar" style="width:10%" align="center"  > -->
                                        </h3>  </div>
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php if(isset($upd)){ echo  $upd; } ?>
                                                        </h3>
                                                                        
                                                                        </div>
                                  
                                    <div class="card-body">
                                        <div class="form-row">
                                        <div class="col-md-6">
                                         <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="button" name="printCourseForm" class="btn btn-primary btn-block"><a href="applications.php?msg=<?php echo $payID;  ?> && payID=<?php echo $payID; ?>" style="color:#fff; font-size:18px; padding:5px;" target="_new">Continue Application</a></button></div>
                                             </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="button" name="printCourseForm" class="btn btn-primary btn-block"><a href="UserdashBoard.php?user=<?php echo $user; ?> &&  payID=<?php echo $payID; ?> " style="color:#fff; font-size:18px; padding:5px;" target="_new">Save & Contnue Later</a></button></div>
                                             </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
