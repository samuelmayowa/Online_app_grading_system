<?php
include_once('functions.php');
require_once('connection.php');
if(!isset($_SESSION['user'])){
    header('location:login.php?msg=Login In To Proceeds');
}
$user = $_SESSION['user'];
/*if($app_exist=mysqli_query($con,"SELECT RefNum FROM onlineApplications WHERE Username ='$user'")){
    if($ref=mysqli_num_rows($app_exist)){
        if($ref ==1){
            echo $ref;
            header('location:UserdashBoard.php?user='.$user.' && msg=You Have A Paid Invoce Already Contact Admin for any Assistance');
    }
    }
   
}*/
if(!isset($_SESSION['refNum'])){
    header('location:UserdashBoard.php?msg=You Have Not Generated an Invoice');
}
else{
   
   if(isset($_POST['submitCred'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     
      $refNum = $screenData['refNum'];
      $regNum = $screenData['regNum'];
      $maths = $screenData['maths'];
      $eng = $screenData['eng'];
      $bio = $screenData['bio'];
      $phys = $screenData['phys'];
      $chem = $screenData['chem'];
      $agric = $screenData['agric'];
      $exType = $screenData['exType'];
      $examYear = $screenData['exYear'];
      $civic = $screenData['civic'];
      $econs = $screenData['econs'];
      $geo = $screenData['geo'];
        $query = mysqli_query($con, 
                                    "INSERT INTO Credentials(RegNumber,RefNumber, ExamType, ExamYear, maths,eng,chem,
                                    phys,biol, agric,econs,geog,civic)
                                    VALUES('$regNum','$refNum','$exType','$examYear','$maths','$eng','$chem','$phys', '$bio','$agric','$econs','$geo',
                                    '$civic')");
                                    if(!$query){
                                        $msg= "Unbale to Submit Credentials ".mysqli_error($con);
                                        //echo $msg="<script> alert('Unable to Submit Credentials'); </script>";
                                    }else{
                                        echo $msg="<script> alert('Credentials Submitted Successfully'); </script>";
                                        header('location:uploadPassport.php?regNum='.$refNum);
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload Your Credentials</h3></div>
                                     <div class="card-body">
                                         <form action="uploadCredentials.php" method="POST">
                                        <div class="form-row"><span style="color:red;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Receipt Number:</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Receipts Number" name="refNum" value="<?php if(isset($_SESSION['payID'])){ echo $_SESSION['payID']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Registration Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Receipts  Number" name="regNum" value="<?php if(isset($_SESSION['regNum'])){ echo $_SESSION['regNum']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Result Type:</label>
                                                        <select name="exType" size="1" class="form-control py-4" required>
                                                            <option value="0">Seleect Type</option>
                                                            <option value="WAEC">WAEC</option>
                                                            <option value="NECO">NECO</option>
                                                            <option value="NATTEB">NABTEB</option>
                                                            <option value="GCE">GCE</option>
                                                            <option value="A LEVEL">A LEVEl</option>
                                                            
                                                        </select>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Exam Year</label>
                                                        <input class="form-control py-4" id="inputLastName" type="YEAR" name="exYear" placeholder="Enter Exam Year"  value="<?php if(isset($exYear)){ echo $exYear; } ?>" required />
                                                    </div>
                                                </div>
                                           
                                            
                                             <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">English</label>
                                                        <input class="form-control py-4" id="inputPassword" name="eng" type="text" placeholder="SubGrade"  value="<?php if(isset($eng)){ echo $eng; } ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Maths</label>
                                                        <input  id="inputProg" class="form-control py-4" name="maths" type="text" placeholder="SubGrade"  value="<?php if(isset($maths)){ echo $maths; } ?>" required />   </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Biology</label>
                                                        <input class="form-control py-4" id="inputPassword" name="bio" type="text" placeholder="SubGrade"  value="<?php if(isset($midName)){ echo $midName; } ?>"  required />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Physics</label>
                                                        <input  id="inputProg" class="form-control py-4" name="phys" type="text" placeholder="SubGrade"  value="<?php if(isset($phys)){ echo $phys; } ?>" required />                                                    </div>
                                                </div>
                                                </div>
                                               
                                                <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Chemistry</label>
                                                        <input class="form-control py-4" id="inputPassword" name="chem" type="text" placeholder="SubGrade"  value="<?php if(isset($econs)){ echo $econs; } ?>"  />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Econs </label>
                                                        <input  id="inputProg" class="form-control py-4" name="econs" type="text" placeholder="SubGrade"  value="<?php if(isset($econs)){ echo $econs; } ?>"  /> </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Agric</label>
                                                        <input class="form-control py-4" id="inputPassword" name="agric" type="text" placeholder="SubGrade"  value="<?php if(isset($agric)){ echo $agric; } ?>"  />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Geo</label>
                                                        <input  id="inputProg" class="form-control py-4" name="geo" type="text" placeholder="SubGrade"  value="<?php if(isset($geo)){ echo $geo; } ?>"  />                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Civic Education</label>
                                                        <input  id="inputProg" class="form-control py-4" name="civic" type="text" placeholder="SubGrade"  value="<?php if(isset($civic)){ echo $civic; } ?>"  />                                                    </div>
                                                </div>
                                                </div>
                                           
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="submitCred" class="btn btn-primary btn-block">Submit Credentials</button></div>
                                             
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
