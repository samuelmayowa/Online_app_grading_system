<?php 
include_once('functions.php');
require_once('connection.php');
$msg="";
if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
}
$admin="web123@$";
$id="";
if(isset($_POST['login'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    
    $username = $screenData['username'];
    $password = $screenData['password'];
    $password = sha1($password);
    //$adminpass=sha1($admin);
    
	$query =mysqli_query($con, "SELECT ID, Username From userAccounts Where Username ='$username' AND Password ='$password'");
	$query2 =mysqli_query($con, "SELECT ID, Username From adminpassword Where admin_key ='$password'");
if(!$query2){
	$msg = "Unable To Perform your Transaction".mysqli_error($con);
	}else{
	    $usrss =mysqli_num_rows($query);
	    if($usrss ==1){
	        $query3 =mysqli_query($con, "SELECT ID, Username From userAccounts Where Username ='$username'") or die(mysqli_error($con));
	        $usrs =mysqli_fetch_assoc($query3);
	        $usrs = $usrs['Username'];
	    }
	    $adm=mysqli_fetch_assoc($query2);
	    $pas=$adm['admin_key'];
	    if($username == $usrs && password==$pas){
	        header('location:UserdashBoard.php?user='.$username);
	    }
	}
	if(!$query){
	$msg = "Unable To Perform your Transaction".mysqli_error($con);
	}else{
	    $usr =mysqli_num_rows($query);
	  if(!empty($usr)){
	      while($user=mysqli_fetch_array($query)){
	          $id=$user['ID'];
	          $pssk=$user['Username'];
	      }
	      $_SESSION['user'] = $username;
	      $_SESSION['userID'] = $username;
	      $_SESSION['ID']=$id;
	      $_SESSION['user_id'] = $id;
	      setcookie('id', $_SESSION['ID'], time()+3600,'/');
	      setcookie('user', $_SESSION['user'], time()+3600,'/');
	      setcookie('user', $_SESSION['userID'], time()+3600,'/');
	      
	      header('location:UserdashBoard.php?user='.$username);
  
	  }elseif($username == $usrs && $password == $pas){
        header('location:UserdashBoard.php?user='.$username);
    }
	  
	  
	  else{
	      $msg="Invalid Credentials";
	  }
	   
	}
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-Login</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        /*label{font-size:24px; padding:10px; font-family:Arial Black; }*/
            
        
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-lg mt-8">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;">Applicants Login</h3></div>
                                    <div class="card-body">
                                       
                                        <form action="close_applications_redir.php" Method="POST">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username: &nbsp; </label><span style="color:red; font-size:12px;"><?php if(isset($msg)){ echo  $msg; }?> </span>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Enter Username" name="username" required />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter Your Password"  name ="password" required />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#password.html">Forgot Password?</a>
                                                <button class="btn btn-primary"  name="login" type="submit">Applicant Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">
                                            <a href="createAccount.php"> Need an account? (Create User Account Here) Or Sign up! &nbsp; &nbsp; &nbsp;</a> || &nbsp; &nbsp; &nbsp;
                                            <a href="https://eportal.escohsti-edu.ng/index.html"> >> Return To Portal Home</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <span>&nbsp;</span>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted" style="Text-align:center;">Copyright &copy; Ekiti State College Of Health Science and Technology, PMB 316, Epe-Ijero Road, Ijero-Ekiti, Ekiti State, Nigeria. 2021</div>
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
