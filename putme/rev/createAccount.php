<?php 
include_once('functions.php');
require_once('connection.php');
/*if(!isset($_SESSION['user'])){
    header('location:login.php?msg=Login In To Proceeds');
}*/
if(isset($_POST['creatAccount'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    
    $fname=$screenData['fname'];
     $midname = $screenData['Othername'];
    $lname=$screenData['lname'];
    $email = $screenData['email'];
     $username = $screenData['username'];
    $password = $screenData['password'];
    $confPassword = $screenData['confPassword'];
    $phno = $screenData['phno'];
    if($password != $confPassword){
       $msg=  "<script> alert('Your Password Does Not match');<script>";
        //header('location:createAccount.php');
    } else {
            if($usr=mysqli_query($con,"SELECT Username From userAccounts Where Username ='$username'")){
                if(mysqli_num_rows($usr) >=1){
                $msg="Username Already Taken";
                }
             else{
                if(!$usr){
                    $msg = "Error :".mysqli_error($con);
                }
                 
             }
        $password = sha1($password);
        $query=mysqli_query($con,"INSERT INTO userAccounts (FirstName, MidName, LastName, Email,Username , Password, PhoneNumber)
                                VALUES('$fname','$midname', '$lname', '$email', '$username', '$password', '$phno')");
                                
                                if(!$query){
                                    echo  mysqli_error();
                                  //$msg ="<script> alert('There Was Error Creating Your Account')<script>";
                                } else {
                                    //echo "Your Account Created Successfully";
                                   //$msg ="<script> alert('Account Created Successfully')<script>";
                                   $_SESSION['user'] = $username;
                                   header('location:login.php?id='.$username);
                                }
    }
        }
}
//echo $msg; 
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Application Account</h3></div>
                                    <div class="card-body">
                                        <form action="createAccount.php" method="POST"> 
                                            <div class="form-row">
                                                <div class="col-md-6"><span style="color:red; font-family:comic sans MS;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" required type="text" placeholder="Enter first name" name="fname" value="<?php if(isset($fname)){ echo  $fname; } ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" name="lname" placeholder="Enter Surname" value="<?php if(isset($lname)){ echo  $lname; } ?>"  required />
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">OtherName</label>
                                                        <input class="form-control py-4" id="inputOthername" name="Othername" type="text" placeholder="Enter OtherNames" value="<?php if(isset($midname)){ echo  $midname; } ?>"  required  />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Username</label>
                                                        <input class="form-control py-4" id="inputusername" name="username" type="text" placeholder="Enter Username" value="<?php if(isset($username)){ echo  $username; } ?>"  required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" value="<?php if(isset($email)){ echo  $email; } ?>"  required />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Phone Number</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="phno" type="tex" aria-describedby="phonelHelp" placeholder="Enter Phone Number"  value="<?php if(isset($phno)){ echo  $phno; } ?>"  required/>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" name="confPassword" type="password" placeholder="Confirm password" />
                                                    </div>
                                                </div>
                                                <script>
                                                    var password = document.getElementById("inputPassword")
  , confirm_password = document.getElementById("inputConfirmPassword");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
                                                </script>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="creatAccount" class="btn btn-primary btn-block">Create Account</button></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a> &nbsp; &nbsp; || &nbsp; &nbsp; 
                                            <a href="https://eportal.escohsti-edu.ng/index.html"> >> Return To Portal Home</a></div>
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
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, PMB 316, Epe-Ijero Road, Ijero-Ekiti, Ekiti State, Nigeria. 2021 </div>
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
