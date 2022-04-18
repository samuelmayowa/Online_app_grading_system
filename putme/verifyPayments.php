<?php 
include_once('functions.php');
require_once('connection.php');
 $type = '2020/2021 Application Form';
    $status = 'Payment Reference generated';
    $stdID = $user_id = $_SESSION['user_id'];
    $rrdata = getinvoiceWithType($stdID,$status,$type,$con);
    $screenData = getuserdata($user_id,$con);
    
     $fname = $screenData['FirstName'];
    $lname = $screenData['LastName'];
    $midName = $screenData['Othername'];
    $email = $screenData['Email'];
    $username = $screenData['Username'];
    //$school = $screenData['school'];
    $payingFor = $type;
    $phno = $screenData['PhoneNumber'];
    $amount = $rrdata['Amount'];
    $refNNum= $rrdata['RefNum'];
    $status=$rrdata['InvoiceStatus'];
   // $statusCode = $rrdata['rrr_statuscode'];
    $orderID= $rrdata['RefOrderID'];
    $stdID= $_SESSION['userID'];
    if(empty($rrdata)){
    header("location:UserdashBoard.php?user={$username}");
}elseif(!empty($rrdata)){
    header("location:generateInvoice_copy.php");
}

                                                // Fetch Department
                                                $amount="";
                                                $sql_department = "SELECT Amount FROM paymentCategories WHere payCategories='Application Form Fees'";
                                                $fees = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($fees)){
                                                   
                                                    $amount = $row['Amount'];
                                                      }
                                                   
                                                ?>
<?php

?>

<?php

 $user= $_GET['user'];
    $file_path ="";
$filelocation="";
$userRef="";
$stats="";
$userRef=$_GET['refNum'];
//echo "<script> alert('$userRef');</script>";
$user = $_SESSION['user'];
if($app_exist=mysqli_query($con,"SELECT RefNum FROM onlineApplications WHERE Username ='$user'  AND Status=3")){
    if($ref=mysqli_num_rows($app_exist)){
        if($ref ==1){
            header('location:UserdashBoard.php?user='.$user.' && msg=You Have A Paid Invoce Already Contact Admin for any Assistance');
    }
    }
}
    if($usr_ref=mysqli_query($con,"SELECT RefNum,Status FROM onlineApplications WHERE Username ='$user'")){
        while($usrs=mysqli_fetch_array($usr_ref)){
            $refNum = $usrs['RefNum'];
              $stats = $usrs['Status'];
    }
    // echo "<script> alert('$stats');</script>";
    //Check The Request User Have Paid and Redirect
    // if($refNum != "" && $stats==0){
   
    
if($refNum != "" && $stats==0){
    
    echo "<script> alert('$refNum');</script>";
     header('location:applications.php?user='.$user . ' && payID='.$refNum. ' && msg=Your Application Is 0/3 Completed');
    } elseif($stats==1){
        
     header('location:uploadCredentials.php?user='.$user . ' && payID='.$refNum. ' && msg=Your Application Is 1/3 Completed');
    }elseif($stats==2){
        
     header('location:uploadPassport.php?user='.$user . ' && payID='.$refNum. ' && msg=Your Application Is 2/3 Completed');
    }elseif($stats==3){
       $_SESSION['refNum']=$refNum;
     header('location:UserdashBoard.php?user='.$user . ' && payID='.$refNum. ' && msg=Your Application Is Completed');
    }
   
}
// }
if(!isset($_SESSION['user'])){
    header('location:login.php?msg=You Have Not Paid For The Invoice');
} else{
    $user =$_SESSION['user'];
    $query = mysqli_query($con, "SELECT * FROM userAccounts Where Username ='$user'");
    if(!$query){
        $msg ="Unable To Find User Details".mysqli_error($con);
    }else{
        while($results = mysqli_fetch_array($query)){
            $id = $results['ID'];
            $fname = $results['FirstName'];
            $midName = $results['MidName'];
            $lname =$results ['LastName'];
            $email = $results['Email'];
            $phno = $results['PhoneNumber'];
            $_SESSION['user_id'] = $id;
            
        }
    }
}

	/*"payerName": '.$fullname.',
	"payerEmail": '.$email.',
	"payerPhone": '.$phno.',*/
	
//include 'rrr-generate.php';

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
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Generate Invoice For 2021/2022 Application Form</h3></div>
                                    <div class="alert"></div>
                                    <!--<button onclick="clickButton()">Click me!</button>-->

<p id="rrr"></p>
<p id="statuscode"></p>
<p id="status"></p>
                                    <div class="card-body">
                                        <form action="generateInvoice_copy.php" method="POST"> 
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
                                                        <label class="small mb-1" for="inputConfirmPassword">Username</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" name="username" type="text" placeholder="Enter Username"  value="<?php if(isset($user)){ echo $user; } ?>" readonly />
                                                        <input class="form-control py-4" type="hidden" id="rrr_value" value="" name="rrr_value" />
                                                        <input class="form-control py-4" type="hidden" id="rrr_status" value="" name="rrr_status" />
                                                        <input class="form-control py-4" type="hidden" id="rrr_statuscode" value="" name="rrr_statuscode" />
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
                                                        <!--<input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" />-->
                                                         <!--<select name="school" class="form-control py-4" id="faculty" size="1">
                                                            <option value="0">..Select School..</option>-->
                                                            <?php 
                                                /*// Fetch Department
                                                $cc="";
                                                $sql_department = "SELECT * FROM Faculties";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $courseId = $row['FacultyID'];
                                                    $cId = $row['FacultyName'];
                                                     $cc .="<option value='$courseId'>$cId</option>";
                                                     
                                                  }
                                                    // Option
                                                   
                                            echo $cc;*/
                                                ?><!--</select>
                                                    </div>
                                                </div>-->
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Applying For</label>
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="What Are You Paying For?" value="2020/2021 Application Form"  readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Application Fee</label>
                                                <input class="form-control py-4" id="inputamount" name="amount" type="tex" aria-describedby="amountHelp" placeholder="Enter Amount"   value="<?php if(isset($amount)){ echo $amount; } ?>" readonly/>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="invoice" class="btn btn-primary btn-block">Generate Invoice</button></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="UserdashBoard.php"> >>>Back</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <br />
            <br />
            <div> &nbsp; </div>
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
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        
        
<script>
function clickButton() {
  var s = document.createElement("script");
  s.src = "rrr-generate.php?user=<?php echo $user;?>";
  document.body.appendChild(s);
}
var s = document.createElement("script");
  s.src = "rrr-generate.php?user=<?php echo $user; ?>";
  document.body.appendChild(s);

function jsonp (ReturnedValue) {
  /*document.getElementById("rrr").innerHTML = ReturnedValue.RRR;
  document.getElementById("status").innerHTML = ReturnedValue.status;
  document.getElementById("statuscode").innerHTML = ReturnedValue.statuscode;*/
  
  document.getElementById("rrr_value").innerHTML = ReturnedValue.RRR;
  document.getElementById("rrr_status").innerHTML = ReturnedValue.status;
  document.getElementById("rrr_statuscode").innerHTML = ReturnedValue.statuscode;
  $('#rrr_value').val(ReturnedValue.RRR);
  $('#rrr_status').val(ReturnedValue.status);
  $('#rrr_statuscode').val(ReturnedValue.statuscode);
}
</script>
    </body>
</html>
