<?php
include_once('functions.php');
require_once('connection.php');
$refNum="";
$regNum="";
$user = $_SESSION['user'];
if($app_exist=mysqli_query($con,"SELECT RefNum FROM onlineApplications WHERE Username ='$user'")){
    if($ref=mysqli_num_rows($app_exist)){
        if($ref ==1){
            
            header('location:UserdashBoard.php?user='.$user.' && msg=You Have A Paid Invoce Already Contact Admin for any Assistance');
    }
    }
   
}
if(isset($_GET['payID'])){
    $_SESSION['payID'] = $_GET['payID'];
    $fname = $_SESSION['fname'];
     $lname= $_SESSION['lname'] ;
     $midName=  $_SESSION['midName'];
    $email = $_SESSION['email'] ;
      $school=$_SESSION['school'];
   $phno = $_SESSION['phno'];
   $amount = $_SESSION['amount'];
}

   if(isset($_POST['submitAppl'])){
       
        $fname = $_SESSION['fname'];
     $lname= $_SESSION['lname'] ;
     $midName=  $_SESSION['midName'];
    $email = $_SESSION['email'] ;
      $school=$_SESSION['school'];
   $phno = $_SESSION['phno'];
   $amount = $_SESSION['amount'];
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $gender = $screenData['gender'];
     $dept= $screenData['dept'];
     $contactAddr= $screenData['ContactAddr'];
      $prog= $screenData ['prog'];
      $lga =$screenData['lga'];
      $stOrigin =$screenData['states'];
      $dateReg =$screenData['dateReg'];
      $refNum = $screenData['refNum'];
      $regNum = $screenData['regNum'];
      $_SESSION['refNum'] =$refNum;
      $_SESSION['regNum'] = $regNum;
     //$amt =$_SESSION['amount']; 
        $query = mysqli_query($con, 
                                    "INSERT INTO onlineApplications(FirstName,MiddleName, Surname, PhoneNO, Email,AmountPaid, Schools,Departments,
                                    Address,Programme,RegNumber,RefNum,StOrigin,LGA,Gender,Username)
                                    VALUES('$fname','$midName','$lname','$phno','$email','$amount','$school','$dept','$contactAddr','$prog','$regNum','$refNum',
                                    '$stOrigin','$lga','$gender','$user' )");
                                    if(!$query){
                                        $msg= "There Was Error In Submitting Your Application Form".mysqli_error($con);
                                        //echo $msg="<script> alert('Unable to Submit Applications'); </script>";
                                    }else{
                                        $msg="Your Application Was Received Successfully";
                                        //$msg="<script> alert('Unable to Submit Applications'); </script>";
                                        header('location:uploadCredentials.php?regNum='.$refNum);
                                    }
                                    
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
        <title>Eportal-2021/2022-Applications</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        label{font-size:24px; padding:10px; font-family:Arial Black; }
            
        
        </style>
        <script src="jquery.min.js"></script>
    <script src="jquery.stateLga.js"></script>
    <script src="jquery.ucfirst.js"></script>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Online Application for 2020/2021 Admission</h3></div>
                                     <div class="card-body"><?php if(isset($msg)){ echo $msg; }?>
                                         <form action="applications.php" method="POST">
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Receipt Number:</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="refNum" value="<?php if(isset($_GET['payID'])){ echo $_GET['payID']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Registration Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="regNum" value="<?php if(isset($school)){ echo $_GET['payID'].$school.'2021'; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" name="fname" value="<?php if(isset($fname)){ echo $fname; } ?>" readonly required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" name="lname" placeholder="Enter Surname"  value="<?php if(isset($lname)){ echo $lname; } ?>" readonly required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">OtherName</label>
                                                        <input class="form-control py-4" id="inputPassword" name="Othername" type="text" placeholder="Enter OtherNames"  value="<?php if(isset($midName)){ echo $midName; } ?>" readonly required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Gender</label>
                                                        <select name="gender" size="1" class="form-control py-4">
                                                            <option value="0">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            
                                                        </select>
                                                        <!--<input  id="inputProg" name="prog" type="text" placeholder="Enter programme"  value="Full Time" readonly />-->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address"  value="<?php if(isset($email)){ echo $email; } ?>" readonly required />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Phone Number</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="phno" type="tex" aria-describedby="phonelHelp" placeholder="Enter Phone Number"   value="<?php if(isset($phno)){ echo $phno; } ?>" readonly required />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Schools</label>
                                                        <input class="form-control py-4" id="inputSchools" name="school" type="text" placeholder="Enter Schools" readonly  value="<?php if(isset($school)){ echo $school; } ?>" required />
                                                         
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="CourseCode">Department Of Study</label>
                                                        <!--<input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode"  required />-->
                                                        <select name="dept" class="form-control py-4" id="dept" size="1">
                                                            <option value="">..Select Department..</option>
                                                            <?php 
                                                // Fetch Department
                                                $cc="";
                                                $sql_department = "SELECT DISTINCT department FROM students";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    //courseId = $row['DeptID'];
                                                    $cId = $row['department'];
                                                     $cc .="<option value='$cId'>$cId</option>";
                                                     
                                                  }
                                                    // Option
                                                   
                                            echo $cc;
                                                ?>
                                                             </select>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">State</label>
                                                        <!--<input class="form-control py-4" id="inputState" type="text" placeholder="Your State Of Origin"  name="stateOR" required  Value="<?php //if(isset($_SESSION['stOrigin'])){ echo $_SESSION['stOrigin']; }  ?>" />-->
                                                         <select name="states"   class="form-control py-4" id="states" size="1" required>
                                                          </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">LGA</label>
                                                      <!-- <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Local Govt Area" name="lga" required  Value="<?php // if(isset($_POST['lga'])){ echo $_POST['lga']; } ?>" />-->
                                                         <select name="lga" id="lgas"  class="form-control py-4" size="1" required></select>
                                                    </div>
                                                </div>
                                               </div>
                                                <script>	
var option = '';

var states=$.nigeria.states();
for (var i=0;i<states.length;i++){
   option += '<option value="'+ states[i] + '">' + $.ucfirst(states[i]) + '</option>';
}
$('#states').append(option).on('change',function() {

var option = '';
option += '<option value="">Local government</option>';

var lgas=eval('$.nigeria.'+ this.value);

for (var i=0; i < lgas.length; i++){
   option += '<option value="'+ lgas[i] + '">' + $.ucfirst(lgas[i]) + '</option>';
}

$('#lgas').find('option')
    .remove()
    .end().append(option);

})
.trigger('change');

</script>
                                      
                                         <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Contact Address</label>
                                                        <textarea class="form-control py-4" id="inputContactAddr" cols="100" rows="2" placeholder="Your Residential Address" name="ContactAddr" required><?php if(isset($_POST['ContactAddr'])){ echo $_POST['ContactAddr']; } ?></textarea>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Paying For</label>
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="Service Paid Form" value="<?php if(isset($school)){ echo $school .' Application Form'; } ?>" readonly />
                                                    </div>
                                                </div>
                                                
                                               </div>
                                   
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Programme</label>
                                                        <input class="form-control py-4" id="inputProg" required name="prog" type="text" placeholder="Enter programme"  value="Full Time" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Date Registered</label>
                                                        <input class="form-control py-4" id="inputProg" required name="dateReg" type="Date" placeholder="Date Of registration" />
                                                    </div>
                                                </div>
                                             </div>
                                             
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="submitAppl" class="btn btn-primary btn-block">Submit Application</button></div>
                                             
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
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
