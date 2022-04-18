<?php
include_once('functions.php');
require_once('connection.php');
if(isset($_POST['genInv'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $fname = $screenData['fname'];
    $lname = $screenData['lname'];
    $midName = $screenData['Othername'];
    $email = $screenData['email'];
    $school = $screenData['school'];
    $payingFor = $screenData['payingFor'];
    $phno = $screenData['phno'];
    $amount = $screenData['amount'];
    $_SESSION['fname'] =$fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['midName'] = $midName;
    $_SESSION['email'] = $email;
    $_SESSION['school'] = $school;
    $_SESSION['phno']= $phno;
    $_SESSION['amount'] = $amount;
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
                        <a class="dropdown-item" href="myProfiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Invoice For 2020/21 Online Application Form </h3></div>

                                        <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php if(isset($upd)){ echo  $upd; } ?>
                                                        </h3>
                                                                        
                                                                        </div>
                                  
                                    <div class="card-body">
                                         <form onsubmit="makePayment()" id="payment-form">
    <ul class="form-style-1">
        <li>
            <label>Full Name <span class="required">*</span></label>
            <input type="text" id="js-firstName" name="firstName" class="form-control py-4" placeholder="First" value="<?php if(isset($fname)){ echo $fname; } ?>" readonly />&nbsp;
            <input type="text" id="js-lastName" name="lastName" class="form-control py-4" placeholder="Surname" value="<?php if(isset($lname)){ echo $lname; } ?>" readonly />
        </li>
        <li>
            <label>Email <span class="required">*</span></label>
            <input type="email" id="js-email" name="email" class="form-control py-4"  value="<?php if(isset($email)){ echo $email; } ?>" readonly/>
        </li>
        <li>
            <label>Narration <span class="required">*</span></label>
            <input type="text" id="js-narration" name="narration" class="form-control py-4" value="<?php if(isset($school)){ echo $school .' Application Form'; } ?>" readonly />
        </li>
        <li>
            <label>Amount <span class="required">*</span></label>
            <input type="number" id="js-amount" name="amount" class="form-control py-4"  value="<?php if(isset($amount)){ echo $amount; } ?>" readonly />
        </li>
        <li>
            <input type="button" onclick="makePayment()" value="Pay Now "/>
        </li>
    </ul>
</form> 
<!--<script type="text/javascript" src="remita-pay-inline.bundle.js"></script>-->

<script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>

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
                 $(document).ready(function(){
            $("#button").click(function(){
                /*var name=$("#name").val();
                var email=$("#email").val();*/
                var email= "<?php json_decode(response,true);  ?>";
                $.ajax({
                    url:'insert.php',
                    method:'POST',
                    data:{
                        name:name,
                        email:email
                    },
                   success:function(data){
                       alert(data);
                   }
                });
            });
        });
                 console.log('callback Successful Response', response);
            window.location.href ='receipts.php?payID='+Math.floor((Math.random() * 1000000000) + 1);
             
              //var data:response;
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
       
    </body>
</html>
