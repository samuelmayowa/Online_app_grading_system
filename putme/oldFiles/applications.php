<?php

include_once('functions.php');
require_once('connection.php');
$refNum="";
$regNum="";
$school="";
confirmAppUser ();
$user = $_SESSION['user'];
/*if($app_exist=mysqli_query($con,"SELECT RefNum FROM ApplicantsPayments WHERE Username ='$user'")){
    if($ref=mysqli_num_rows($app_exist)){
        if($ref ==1){
            
             header('location:UserdashBoard.php?user='.$user.' && msg=You Have Paid, Started and The Completed Application, ( Contact Admin for any Assistance )');
    }
    }
   
}*/
if(isset($_GET['payID'])){
    $_SESSION['payID'] = $_GET['payID'];
    $fname = $_SESSION['fname'];
     $lname= $_SESSION['lname'] ;
     $midName=  $_SESSION['midName'];
    $email = $_SESSION['email'] ;
      $school=$_POST['school'];
   $phno = $_SESSION['phno'];
   $amount = $_SESSION['amount'];
}
$fcname="";
$facID="";
   if(isset($_POST['submitAppl'])){
        //
        
        $fname = $_SESSION['fname'];
     $lname= $_SESSION['lname'] ;
     $midName=  $_SESSION['midName'];
    $email = $_SESSION['email'] ;
      $school=$_SESSION['school'];
   $phno = $_SESSION['phno'];
   $amount = $_SESSION['amount'];
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $gender = $screenData['gender'];
     $facs=$screenData['facs'];
     $dept= $screenData['dept'];
     $contactAddr= $screenData['ContactAddr'];
      $prog= $screenData ['prog'];
      $lga =$screenData['lga'];
      $stOrigin =$screenData['states'];
      //$dateReg =$screenData['dateReg'];
      $refNum = $screenData['refNum'];
      $regNum = $screenData['regNum'];
      $birthDate= $screenData['birthDate'];
      
      $query=mysqli_query($con, "Select FacultyID, FacultyName From Faculties Where ID ='$facs'");
     while( $fc=mysqli_fetch_array($query)){
         $facID = $fc['FacultyID'];
          $fcname=$fc['FacultyName'];
      }
      $regNum = $_SESSION['payID'].$facID.'2021';
      $_SESSION['refNum'] =$refNum;
      $_SESSION['regNum'] = $regNum;
        $query = mysqli_query($con, 
                                    "INSERT INTO onlineApplications(FirstName,MiddleName, Surname, PhoneNO, Email, Schools,Departments,
                                    Address,Programme,RegNumber,AmountPaid,RefNum,BirthDate,StOrigin,LGA,Gender,Username, Status)
                                    VALUES('$fname','$midName','$lname','$phno','$email','$fcname','$dept','$contactAddr','$prog','$regNum','$amount','$refNum',
                                    '$birthDate','$stOrigin','$lga','$gender','$user',1 )");
                                     
                                    if(!$query){
                                        $msg= "There Was Error In Submitting Your Application Form".mysqli_error($con);
                                        //echo $msg="<script> alert('Unable to Submit Applications'); </script>";
                                    }else{
                                        
                                        //$msg="Your Application Was Received Successfully";
                                        // echo $msg="<script> alert('Unable to Submit Applications'); </script>";
                                        header('location:uploadCredentials.php?regNum='.$refNum .' && msg=Application Saved Successfully ');
                                    }
                                    
   }
/*$num = Math.floor(Math.rand() * 1000000000)+1;
echo  $num;
/*for($i=0;$i<=100;$i++) {
echo sprintf("%05d", $i);
//exit;
}*/
/*$reg="";
$num = rand(1, 1000);
$reg=  "CHST/2021"."/0".$num;

function getRegNum(){
   
    $initNum='001';
   // $regNum=$initNum;
  
   // return  $regNum;
     
}*/
//$regNum++;
//srand(001); 
//echo   "Index: " . "CHST/2021"."/0".mt_rand(getRegNum(), 9999);*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ile, Abiye" />
        <meta name="author" content="" />
        <title>Eportal-2021-Applications</title>
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
    
    
                                                  
          <script src="jquery.js" type="text/javascript"></script> 
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Online Application Form for 2021/2022 Admission</h3></div>
                                     <div class="card-body"><span style="color:red; font-size:12px; font-family:comic sans MS;"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?> <?php if(isset($msg)){ echo $msg;  }?></span>
                                         <form action="applications.php" method="POST">
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Receipt Number:</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="refNum" value="<?php if(isset($_SESSION['payID'])){ echo $_SESSION['payID']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Registration Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="regNum" value="<?php if(isset($_SESSION['payID'])) { $_SESSION['regNum']= "CHST/2021/0".rand(1, 999); echo $_SESSION['regNum'];  } else { echo $_SESSION['payID'].$school.'2021'; } ?>"  readonly required />
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
                                                            <option value="0">Seleect Gender</option>
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
                                                        <!--<input class="form-control py-4" id="inputSchools" name="school" type="text" placeholder="Enter Schools" readonly  value="<?php if(isset($school)){ echo $school; } ?>" required />-->
                                                         <select name="facs" class="form-control py-4" id="facs" size="1">
                                                            <option value="">..Select School..</option>
                                                            <?php 
                                                // Fetch Department
                                                $cc="";
                                                $facId="";
                                                $fac = "SELECT  ID,FacultyName FROM Faculties";
                                                $facs = mysqli_query($con,$fac);
                                                while($row = mysqli_fetch_assoc($facs) ){
                                                    $facId = $row['ID'];
                                                    $cId = $row['FacultyName'];
                                                     $cc .="<option value='$facId'>$cId</option>";
                                                     
                                                  }
                                                    // Option
                                                   
                                            echo $cc;
                                                ?>
                                                             </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="CourseCode">Department Of Study</label>
                                                        <!--<input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode"  required />-->
                                                        <select name="dept" class="form-control py-4" id="dept" size="1">
                                                            <option value="">..Select Department..</option>
                                                          
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
                                                        <input class="form-control py-4" id="inputPayingFor" name="payingFor" type="text" placeholder="Service Paid Form" value="<?php  echo ' 20212022 Online  Application Form'; ?>" readonly />
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
                                                        <label class="small mb-1" for="inputConfirmPassword">Birth Date</label>
                                                        <input class="form-control py-4" id="inputDate" required name="birthDate" type="Date" placeholder="Enter Birth Date In 10/10/2020" value="<?php if(isset($_POST['birthDate'])){ echo $_POST['birthDate']; } ?>" />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="submitAppl" class="btn btn-primary btn-block">Submit Application & Continue</button></div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="button" name="saveContinue" class="btn btn-primary btn-block"><a href="UserdashBoard.php?user=<?php echo $user; ?> &&  payID=<?php echo $_SESSION['payID']; ?> " style="color:#fff; font-size:18px; padding:5px;" target="_blank">Save & Contnue Later</a></button></div>
                                             </div>
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
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
