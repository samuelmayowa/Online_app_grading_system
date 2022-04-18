<?php

include_once('functions.php');
require_once('connection.php');
$refNum = "";
$target_file = "";
$user="";
$user=$_SESSION['user'];
$refNum=$_GET['refNum'];
if(!isset($_SESSION['user'])){
    header('location:login.php?msg=Login In To Proceeds');
}
if(!isset($_SESSION['regNum'])){
    header('location:UserdashBoard.php?user='.$user.'  && msg=You Have Not Generated an Invoice');
    exit;
}
else{
   
   $refNum1 =$_SESSION['refNum'];
//}
   
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 
 echo "<script>alert('$refNum1');</script>";
 
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["SendPassport"])) {
  $check = getimagesize($_FILES["foto"]["tmp_name"]);
  if($check !== false) {
    $msg= "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $msg= "<font color='red'>File is not an image.</font>";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  $msg= "<font color='red'>Sorry, file already exists.</font>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["foto"]["size"] > 500000) {
  $msg= "<font color='red'>Sorry, your file is too large.</font>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $msg= "<font color='red'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</font>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $msg= "<font color='red'>Sorry, your file was not uploaded.</font>";
// if everything is ok, try to upload file
} else {
    $sql = mysqli_query($con, "UPDATE  onlineApplications SET photograph ='$target_file', Status=3 WHERE RefNum ='$refNum1'") or die(mysqli_error($con));
    if(!$sql){
        $msg= "Unable to Store Your Photograp".mysqli_error($con);
    }
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
     
     $msg= "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded Successfully.";
     header('location:photoCard.php?msg='.$msg. ' && user='.$user);
      }else{
          $msg="There was Error Storing Your Photograph".mysqli_error($con);
      }
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload Your Credentials</h3></div>
                                     <div class="card-body"><?php if(isset($msg)){ echo $msg; } ?>
                                         <form action="uploadPassport.php" method="POST" enctype="multipart/form-data">
                                          
                                          
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Receipt Number:</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Receipts Number" name="refNum" value="<?php if(isset($_SESSION['payID'])){ echo $_SESSION['payID']; } elseif(isset($_GET['payID'])) { echo $_GET['payID']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Registration Number</label>
                                                        <input class="form-control py-4" id="inputRegNum" type="text" placeholder="Your Receipts  Number" name="regNum" value="<?php if(isset($_SESSION['regNum'])){ echo $_SESSION['regNum']; } ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                <div class="form-row">

                                                
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Select image to upload:</label>
                                                        <input class="form-control py-4" id="inputLastName" type="file" name="foto" placeholder="your Passport"  value="" required />
                                                    </div>
                                                </div>
                                           
                                            
                                            
                                           
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="SendPassport" class="btn btn-primary btn-block">Upload Passport</button></div>
                                             
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

