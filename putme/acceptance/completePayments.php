<?php
require_once('../functions.php');
require_once('../connection.php');
//confirmLogin();


//confirmPswd();

?>
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
         <link href="cssRm.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!--<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
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
                        <a class="dropdown-item" href="myProfiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                                Student Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Manager Payments
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#login.html">School Fees</a>
                                            <a class="nav-link" href="#register.html">Compulsory Fees</a>
                                            <a class="nav-link" href="#password.html">Apllication</a>
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
                            <div class="sb-sidenav-menu-heading">Receipts</div>
                            <a class="nav-link" href="generateRecipts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Reprint Receipts
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
                                    
<form onsubmit="makePayment()" id="payment-form">
    <ul class="form-style-1">
        <li>
            <label>Full Name <span class="required">*</span></label>
            <input type="text" id="js-firstName" value="<?php if(isset($_SESSION['fname'] ) ){
                            echo $_SESSION['fname'];
                        }?>" name="firstName" class="form-control py-4" placeholder="First" readonly required />&nbsp;
            <input type="text" id="js-lastName" value="<?php if(isset($_SESSION['lname'] ) ){
                            echo $_SESSION['lname'];
                        }?>" name="lastName" class="form-control py-4" placeholder="Last" readonly  required/>
        </li>
        <li>
            <label>Email <span class="required">*</span></label>
            <input type="email" id="js-email" value="<?php if(isset($_SESSION['email'])){
                            echo $_SESSION['email'];
                        }
                        ?>"  readonly required name="email" class="form-control py-4"/>
        </li>
        <li>
            <label>Narration <span class="required">*</span></label>
            <input type="text" id="js-narration" value="<?php if(isset($_SESSION['payType'])){
                            echo $_SESSION['payType'];
                        }
                        ?>"  readonly required name="narration" class="form-control py-4"/>
        </li>
        <li>
            <label>Amount <span class="required">*</span></label>
            <input type="number" id="js-amount" value="<?php if(isset($_SESSION['amt'] ) ){
                            echo $_SESSION['amt'];
                        }?>" name="amount" class="form-control py-4" required readonly />
        </li>
        <li>
            <input type="button" onclick="makePayment()" value="Pay Now "/>
        </li>
    </ul>
</form>

</div>
<?php if(isset($_SESSION['userID'])){
    
                           $matricNumber =  $_SESSION['userID'];
                            
                            $email = $_SESSION['email'];
                            $courseCode =  $_SESSION['stdPhno'];
                            $amount =  $_SESSION['amt'];
                            $payType =  $_SESSION['payType'];
                            $dept =  $_SESSION['dept'];
                            $matricNumber =  $_SESSION['matricNumber'];
                            $semester =  $_SESSION['semester'];
                            $stdLevel =  $_SESSION['stdLevel'];
                            $fname = $_SESSION['fname'];
                            $lname = $_SESSION['lname'];
    }
    

                        ?>
<script>
    

    function makePayment() {
        var form = document.querySelector("#payment-form");
        var paymentEngine = RmPaymentEngine.init({
            //key: '798431',
            key: 'REVNT05UR0lGVHw0MDgyNTIxNHwxZTI1NGNlNTVhMzkyYTgxYjYyNjQ2ZWIwNWU0YWE4ZTNjOTU0ZWFlODllZGEwMTUwMjYyMTk2ZmFmOGMzNWE5ZGVjYmU3Y2JkOGI5ZWI5YzFmZWMwYTI3MGI5MzA0N2FjZWEzZDhiZjUwNDY5YjVjOGY3M2NhYjQzMTg3NzI4Mg==',
            customerId: form.querySelector('input[name="email"]').value,
            firstName: form.querySelector('input[name="firstName"]').value,
            lastName: form.querySelector('input[name="lastName"]').value,
            email: form.querySelector('input[name="email"]').value,
            amount: form.querySelector('input[name="amount"]').value,
            narration: form.querySelector('input[name="narration"]').value,
            //transactionId: "''+Math.floor((Math.random() * 1000000000) + 1)", // Replace with transaction id
            onSuccess: function (response) {
                window.location.href ='receipts.php?payID='+Math.floor((Math.random() * 1000000000) + 1);
               console.log('callback Successful Response', response);
            },
            onError: function (response) {
                 //window.location.href ='payments.php?payID='+Math.floor((Math.random() * 1000000000) + 1);
                console.log('callback Error Response', response);
            },
            onClose: function () {
                console.log("closed");
            }
        });
         paymentEngine.showPaymentWidget();
    }

   /* window.onload = function () {
        setDemoData();
    };*/
</script>
<!--<script type="text/javascript" src="https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"> </script>-->
<script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
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
</body>
</html>