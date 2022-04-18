<?php 
include_once('functions.php');
require_once('connection.php');
$stdID = $user_id = $_SESSION['user_id'];
$stdID= $_SESSION['userID'];
 
if(!isset($_SESSION['user'])){
    header('location:login.php?msg=Login to proceed');
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


//===== Get News Notification for Student ==========



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
<!--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
--><!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>-->
    </head>
    <body class="bg-primary">
        <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ekiti State College Of HSTI  News Board </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                
                <h2  class="text-center font-weight-light my-4">Notification Results Release For 2021/2022 Admission</h2>

<hr>
<h3  class="text-center font-weight-light my-4">ATTENTION: This Is News Dashboard For 2021/2022 Admission </h3>
<hr>
<p data-bracket-id="23">
    
<?php  //echo getNws($con);  ?>    <hr>

<hr>
<br>
    <br>
<!--<a href="register.php" target="_blank" align="center"><button type="button">Proceed to Create Profile</button></a><hr>-->
    <br>
    <span style="color:#322; font-size:16px;">Phone: +2348130925149 OR +2348038143003 <br> 
Email: admins@escohsti-edu.ng
</span>
    <br>
    - Management
       
</p>

            </div>
        </div>
    </div>
</div>
         <?php include('topbar.php'); ?>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                
                
                
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="images/logo-banner.png" width="80%"></h3></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Check Result</h3></div>
                                    <div class="alert"></div>
                                    <!--<button onclick="clickButton()">Click me!</button>-->

<p id="rrr"></p>
<p id="statuscode"></p>
<p id="status"></p>
                                    <div class="card-body">
                                        <form action="processresult.php" method="POST"> 
                                            
                                             
                                            
                                            <?php 
                                                if(isset($_GET['pin'])){
                                                    $pin = base64_decode(base64_decode($_GET['pin']));
                                                }else{
                                                    $pin = '';
                                                }
                                                
                                                $msg = $_GET['msg'];
                                            ?>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Enter Pin: </label><span style="color:red; font-size:12px;"><?php if(isset($msg)){ echo  $msg; }?> </span>
                                                <input class="form-control py-4" id="pin" name="pin" value="<?php echo $pin;?>" type="text" aria-describedby="phonelHelp" required placeholder="Enter pin">
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Serial No: </label>
                                                <input class="form-control py-4" id="serialNo" name="serialNo" value="" type="text" aria-describedby="phonelHelp" required placeholder="Enter Serial Number">
                                            </div>
                                        
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="resultcheck" class="btn btn-primary btn-block">Check!</button></div>
                                            <!--<div class="form-group mt-4 mb-0"><a href="/genrrr.php" class="btn btn-primary btn-block">Buy Pin</a></div>-->
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
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti. <?php echo date('Y')?></div>
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
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
       
        
        
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
    </body>
</html>
