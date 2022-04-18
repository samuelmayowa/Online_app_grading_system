<?php
require_once('../functions.php');
require_once('../connection.php');
confirmLogin();


confirmPswd();
if(isset($_POST['payments'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $courseCode = $screenData['courseCode'];
     $payType= $screenData['payType'];
     $matricNumber= $screenData['MatricNumber'];
     $dept= $screenData['dept'];
}

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
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
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
                                    <a class="nav-link" href="layout-static.html">Load Courses</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Load Units</a>
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
                                            <a class="nav-link" href="login.html">Assign Courses</a>
                                            <a class="nav-link" href="register.html">Add New</a>
                                            <a class="nav-link" href="password.html">Add Departments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">Load Results</a>
                                            <a class="nav-link" href="404.html">Process Results</a>
                                            <a class="nav-link" href="500.html">Approve Results</a>
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
                                        <form action="#" method="POST" id="paymentForm">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Course CODE</label>
                                                         <select name="dept" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School">....Select Course Code...</option>
                                                            <?php 

                                                                        $CourseNme ='';
                                                                        $CourseID='';
                                                            $query = "SELECT courseCode, CourseName,Dept FROM courses";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $deptID = $schl ['DeptID'];
                                                                $courseName= $schl['CourseName'];
                                                                $courseCode = $schl ['courseCode'];
                                                                
                                                               echo "<option value='$courseName'>$courseCode ". '  '. "($courseName)</option>";

                                                            }

                                                                    //    if(isset($schools)){ echo $schools; } 
                                                                        ?>
                                                                        </select>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Course Title" name="courseCode" required />-->
                                                    </div>
                                                </div>
                                                
                                               
                                           
                                       
                                            <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPayment">Select Payment Category </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="payType" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Category">....Select Payment...</option>
                                                            <option value="Under Graduate">Compulsory payment</option>
                                                            <option value="Post Graduate">School Fees Payment</option>
                                                            <option value="Post Graduate">Acceptance Fees Payment</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Matric Number</label></label>
                                                       
                                         <input class="form-control py-4" id="inputConfirmPassword" name="MatricNumber" type="text" placeholder="matricNumber"  value="<?php if(isset($_SESSION['userID'])){
                            echo $_SESSION['userID'];
                        }
                        ?>" readonly required/>
                                                    </div>
                                                </div>
                                               
                                               
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Course Domicile"  name="dept" />-->
                                                        <select name="dept" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School">....Select Department Id...</option>
                                                            <?php 

                                                                        $depts ='';
                                                                        $deeptID='';
                                                            $query = "SELECT DeptID, DeptName FROM Departments";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $deptID = $schl ['DeptID'];
                                                               
                                                                  $dept = $schl ['DeptName'];
                                                               echo "<option value='$deptID'>$deptID ". '  '. "($dept)</option>";

                                                            }

                                                                    //    if(isset($schools)){ echo $schools; } 
                                                                        ?>
                                                                        </select>
                                                    </div>
                                                </div>
                                         </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<script src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                                           <script src="https://js.paystack.co/v1/inline.js"></script>
                                                          <!--<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                            <div class="form-group mt-4 mb-0"></div>
                                            <button type="button" name="payements" class="btn btn-primary btn-block"  onclick="payWithPaystack()"> Make Payment Now</button>
                                            
                                             </div>
                                             </div>
                                        </form>
                                    </div>
                                    </div>
                </main>
<?php if(isset($_SESSION['userID'])){
                            $matricNumber =  $_SESSION['userID'];
                        }
                        ?>
 <script>
  
    const paymentForm = document.getElementById('paymentForm');

paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {

  e.preventDefault();

  let handler = PaystackPop.setup({

    key: 'pk_test_xxxxxxxxxx', // Replace with your public key

    email: document.getElementById("email-address").value,

    amount: document.getElementById("amount").value * 100,

    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

    // label: "Optional string that replaces customer email"

    onClose: function(){

      alert('Window closed.');

    },

    callback: function(response){

      let message = 'Payment complete! Reference: ' + response.reference;

      alert(message);

    }

  });

  handler.openIframe();

}
</script>
				<!--<script>
					function makePayment() {
					  var paymentEngine = RmPaymentEngine.init({
					     key: ‘798431’',
					      customerId: "140700251",
					      firstName: "Lisa",
					      lastName: "Spark",
					      email: "demo@remita.net",
					      narration: "Payment Description",
					      amount: 19999,
					      onSuccess: function (response) {
					      console.log('callback Successful Response', response);
					      },
					      onError: function (response) {
					      console.log('callback Error Response', response);
					      },
					      onClose: function () {
					      console.log("closed");
					      }
					      });
					      paymentEngine.showPaymentWidget();
					    }
					</script>-->

<!-- Paystack Form -->

<!-- <form id="paymentForm">
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" id="email-address" required />
  </div>
  <div class="form-group">
    <label for="amount">Amount</label>
    <input type="tel" id="amount" required />
  </div>
  <div class="form-group">
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" />
  </div>
  <div class="form-group">
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" />
  </div>
  <div class="form-submit">
    <button type="submit" onclick="payWithPaystack()"> Pay </button>
  </div>
</form>
<script src="https://js.paystack.co/v1/inline.js"></script>  -->


<!-- End Paystack Form -->

        
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
