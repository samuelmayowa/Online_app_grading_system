<?php 
include_once('functions.php');
require_once('connection.php');

                                                // Fetch Department
                                                $amount="";
                                                $sql_department = "SELECT Amount FROM paymentCategories WHere payCategories='Application Form Fees'";
                                                $fees = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($fees)){
                                                   
                                                    $amount = $row['Amount'];
                                                      }
                                                   
                                                ?>
<?php
session_start();
$hsh="";
$merchantID="";
$serviceID="";
$orderID="";
$amt="";
$amt=$amount;
$apiKey="";
$apiKey=1946;
$merchantID='2547916';
$serviceID="4430731";
 $orderID=rand(1,9999999).$merchantID;
 echo "OrderID: " . $orderID ."<br />";
echo $hsh=hash("sha512",$merchantID.$serviceID.$orderID.$amt.$apiKey);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{ 
	"serviceTypeId": '.$serviceID.',
	"amount": '.$amt.',
	"orderId": '.$orderID.',
	"payerName": "John Doe",
	"payerEmail": "doe@gmail.com",
	"payerPhone": "09062067384",
	"description": "Payment for 2021/2022 Application Fees"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: remitaConsumerKey=2547916,remitaConsumerToken='.$hsh
  ),
));
echo "<br />";
$response = curl_exec($curl);
print_r($response);

//$resp= JSON.stringify(json_decode($response, true));
 echo $resp['jsonp']['status'] ."<br />";
 echo $resp['jsonp']['RRR']."<br />";
// echo $resp->statuscode."<br />";
echo $resp['jsonp']['statuscode']."<br />";
 echo var_dump(json_decode($response, true));
 $_SESSION['rrr'] = $resp->RRR;

curl_close($curl);

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
        label{font-size:24px; padding:12px; font-family:Arial Black; }
            
        
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
                                                                      <span style="color:red; font-size:12px;">NOTE: You Are Adviced to Print This page Before Proceed to Payment</span> 
                                                                        </div>
                                  
                                    <div class="card-body">
                                        <label class="small mb-1" for="inputFirstName"><u>Student Invoice Details</u></label>
                                        
                                        <form action="payInvoice_copy.php" method="POST"> 
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" name="fname" value="<?php if(isset($fname)){ echo $fname; } ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" name="lname" placeholder="Enter Surname"  value="<?php if(isset($lname)){ echo $lname; } ?>" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">OtherName</label>
                                                        <input class="form-control py-4" id="inputPassword" name="Othername" type="text" placeholder="Enter OtherNames"  value="<?php if(isset($midName)){ echo $midName; } ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Programme</label>
                                                        <input class="form-control py-4" id="inputProg" name="prog" type="text" placeholder="Enter programme"  value="Full Time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address"  value="<?php if(isset($email)){ echo $email; } ?>" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Phone Number</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="phno" type="tex" aria-describedby="phonelHelp" placeholder="Enter Phone Number"   value="<?php if(isset($phno)){ echo $phno; } ?>" readonly/>
                                            </div>
                                            <div class="form-row">
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Schools</label>
                                                        <input class="form-control py-4" id="inputSchools" name="school" type="text" placeholder="Enter Schools" readonly  value="<?php if(isset($school)){ echo $school; } ?>" />
                                                         
                                                    </div>
                                                </div>-->
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Paying For</label>
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="Service Paid Form" value="2020/21 Application Form"  readonly/>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">PayementReference</label>
                                                        <input class="form-control py-4" id="inputSchools" name="refNum" type="text" placeholder="refNum" readonly  value="<?php if(isset($refNNum)){ echo $refNNum; } ?>" />
                                                         
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Application Fee</label>
                                                <input class="form-control py-4" id="inputamount" name="amount" type="tex" aria-describedby="amountHelp" placeholder="Enter Amount"   value="<?php if(isset($amount)){ echo $amount; } ?>" readonly />
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="genInv" class="btn btn-primary btn-block">Proceed To Invoice payment</button></div>
                                        </form>
                                       <hr /> 
                                            <button class="btn btn-primary btn-block" onclick="window.print()">Print this Invoice</button>
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

<?php 
require_once('close_connection.php');

?>
