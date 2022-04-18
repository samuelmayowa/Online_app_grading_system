<?php
require_once('../functions.php');
require_once('../connection.php');
//confirmLogin();

$refNum="";
$user = $_SESSION['userID'];
if(empty($_SESSION['userID']) && empty($_SESSION['refNum'])){
    header('location:../UserdashBoard.php?msg=You Have Not Updated Your Profile details');
}

//========= Confirm User Have Updated There Profiles ==========

if($stdCat = mysqli_query($con,"Select Email From onlineApplications WHERE Username ='$user'")){
    while ($cat = mysqli_fetch_array($stdCat)){
        $stdEmail = $cat['Email'];
    }
    if(empty($_SESSION['refNum'])){
    header('location:../UserdashBoard.php?msg=Your Application Process Is Incomplete');
}
}

//========== End COnfirm user Profiles ==================
if(isset($_GET['refNum'])){
 $refNum=$_GET['refNum'];
$_SESSION['refnum']= $refNum;
}
confirmPswd();
if(isset($_POST['payments'])){
   /* if($_SESSION['sts']==0){
   // header('location:../UserdashBoard.php?msg=You have Been Provissioned An Admission for This Payment'.' && user='.$user);
} else{*/
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                            $matricNumber =  $_SESSION['userID'];
                            if(isset($_POST['payments'])){
                            $_SESSION['email'] =$screenData['email'];
                            $_SESSION['courseCode'] = $screenData['courseCode'];
                            $_SESSION['stdPhno'] = $screenData['stdPhno'];
                            $_SESSION['payType'] = $screenData['payType'];
                            $_SESSION['amt'] =$screenData['fees'];
                            $_SESSION['dept'] = $screenData['dept'];
                            $_SESSION['matricNumber'] = $screenData['MatricNumber'];
                            $_SESSION['semester'] = $screenData['semester'];
                            $_SESSION['stdLevel'] = $screenData['stdLevel'];
                            $fname = $_SESSION['fname'];
                            $lname =$_SESSION['lname'];
                           
                            // header('location:completePayments.php?userID='.$matricNumber);
                            header('location:remitAcceptance.php?userID='.$matricNumber . '&& refNum='.$refNum);
                            }
    
//}

}
echo "<script>alert('$refNum');</script>";
                        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekti" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <style>a { color:white;}</style>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        
         <script src="jquery.min.js"></script>                                              
        <script src="feesJS.js" type="text/javascript"></script> 
        
        
       <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
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
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../UserdashBoard.php?user=">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:dark; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="dashboard.php">
                                Student DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Student Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Student Course Reg. 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#layout-static.html">Load Courses</a>
                                    <a class="nav-link" href="#layout-sidenav-light.html">Load Units</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Staff Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        HOD Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#login.html">Assign Courses</a>
                                            <a class="nav-link" href="#register.html">Add New</a>
                                            <a class="nav-link" href="#password.html">Add Departments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#401.html">Load Results</a>
                                            <a class="nav-link" href="#404.html">Process Results</a>
                                            <a class="nav-link" href="#500.html">Approve Results</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="uploadStudents.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Load Existing Students
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="Background-color:#28a745;">
                        <div class="small">Logged in as:</div>
                        <?php if(isset($_SESSION['userID'])){
                            echo $_SESSION['userID'];
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Welcome To Student Online Payment System</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="payments.php" method="POST" id="paymentForm">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Email Address</label></label>
                                                       
                                             <input class="form-control py-4" id="email-address" name="email" type="email" placeholder="Email" readonly  value="<?php if(isset($_SESSION['stdEmail'])) { echo $_SESSION['stdEmail']; } ?>" required/>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLevel">Phone Number</label></label>
                                                       
                                             <input class="form-control py-4" id="stdPhno" name="stdPhno" type="text" placeholder="Your Phone Number"  readonly value="<?php if(isset($_SESSION['stdPhno'])){ echo $_SESSION['stdPhno']; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSemester">SESSION</label>
                                                         <select name="semester" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Semester">....Select Session...</option>
                                                            <option value="2021/2022">2021/2022</option>
                                                            <option value="2019/2020">2019/2020</option>
                                                            </select>
                                                             </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName"> Course Of Study</label></label>
                                                         <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Phone Number" readonly name="courseCode" value="<?php if(isset($_SESSION['dpt'])){ echo $_SESSION['dpt']; } ?>" required />
                                                    </div>
                                                </div>
                                                
                                               
                                           
                                       
                                            <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPayment">Select Payment Category </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="payType" class="form-control py-4" id="payType" size="1">
                                                            <option value="Select Category">....Select Payment...</option>
                                                            <?php 
                                                                        $amountPayable="";
                                                                       $payType="";
                                                                       $query = "SELECT payCategories FROM paymentCategories Where payCategories LIKE 'Acceptance%' LIMIT 1";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                // $amountPayable = $schl ['Amountpayable'];
                                                                 $payType .= $schl ['payCategories'];
                                                               $payType.= "<option value='$payType'>$payType</option>";
                                                               }
                                                         
                                                               echo $payType;
                                                               ?>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="amount">Payment Amount </label><span style="color:red; font-size:10px;"> (** Amount Here Is Automatically Calculated By The Portal From Your Initial Balance Due **)</span>
                                                     <select name="fees" id="fees" class="form-control py-4" size="1">
                                                         
                                                         <option value="">Select Amount</option>
                                                        
                                                     </select>
                                         <!--<input class="form-control py-4" id="fees" name="fees" type="text" placeholder="Student Phone Number"  value="<?php if(isset($_SESSION['stdPhno'])) { echo  $_SESSION['stdPhno']; } ?>"  required/>-->
                                                    </div>
                                                </div>
                                               
                                               
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="amount"  name="dept" readonly  value="<?php if(isset($_SESSION['dpt'])){ echo $_SESSION['dpt']; } ?>" />
                                                        
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Matric Number</label></label>
                                                       
                                         <input class="form-control py-4" id="inputConfirmPassword" name="MatricNumber" type="text" placeholder="matricNumber"  value="<?php if(isset($_SESSION['regNum'])){
                            echo $_SESSION['regNum'];
                        }
                        ?>" readonly required/>
                                                    </div>
                                                </div>
                                         </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<script src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                                          
                                                          <!--<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                            <div class="form-group mt-4 mb-0"></div>
                                            <button type="submit" name="payments" class="btn btn-primary btn-block" > INITIALIZE Payment Now </button>
                                            
                                             </div>
                                             </div>
                                        </form>
                                    </div>
                                    </div>
                </main>


        <!--
            GET STARTED WITH YOUR OWN FILES
        -->
        
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
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!--<script src="js/scripts.js"></script>-->
       <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>-->
    </body>
</html>
