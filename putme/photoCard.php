<?php
include_once('functions.php');
require_once('connection.php');

 // confirmLogin();
$file_path ="";
$filelocation="";
$stdEmail = "";
$checkApps="";
$stats="";
$user=$_SESSION['user'];
$checkApps=getAppx($con,$user);

if(!$_SESSION['user']){
   header('location:login.php?msg=You Have not logged IN'); 
} 
if($payID = mysqli_query($con,"SELECT RefNum,Status FROM onlineApplications WHERE Username ='$user'")){
    while($pID = mysqli_fetch_array($payID)){
         $refNum = $pID ['RefNum'];
         $stats = $pID ['Status'];
    }
}
echo "<script>alert('Your Status : $stats');</script>";

if($stats !=3){
   header('location:UserdashBoard.php?msg=Your Application is Incomplete && user='.$user);
}
// Get RRR Details
    $type = '2020/2021 Application Form';
    $stdID = $user_id = $_SESSION['user_id'];
    $statusPaid = 'Successful';
    $rrdataPaid = getinvoiceWithType($stdID,$statusPaid,$type,$con);
    $screenData = getuserdata($user_id,$con);
    
     $fname = $screenData['FirstName'];
    $lname = $screenData['LastName'];
    $midName = $screenData['MidName'];
    $email = $screenData['Email'];
    $username = $screenData['Username'];
    //$school = $screenData['school'];
    $payingFor = $type;
    $phno = $screenData['PhoneNumber'];
    $amount = $rrdataPaid['Amount'];
    $refNNum= $rrdataPaid['RefNum'];
    $status=$rrdataPaid['InvoiceStatus'];
   // $statusCode = $rrdataPaid['rrr_statuscode'];
    $orderID= $rrdataPaid['RefOrderID'];
    $stdID= $_SESSION['userID'];
    
    // end RRR Details Check
    

if(isset($_GET['msg'])){
    $upd= $_GET['msg'];
}
    //prepare Data
if(isset($_SESSION['refNum'])){
    
 
    $regNum=$_SESSION['regNum'];
    $refNum = $_SESSION['refNum'];
    
    
    $query = "SELECT  photograph FROM onlineApplications WHERE RefNum ='$refNum'";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
    while ($results  = mysqli_fetch_array($query)){
       $file_path =  $results ['photograph'];
      // $_SESSION['file_loc'] = $file_path;
        $_SESSION['file_path'] =$file_path;
       
        
    }
   // echo $file_path;
   $mydate=getdate(date("U"));
//}

}
?>
<?php 
        $stdEmail ="";
        $schlID ='';
        $matricID="";
        $refNum="";
        $matricID =$_SESSION['refNum'];
        $query = "SELECT * FROM onlineApplications WHERE RefNum='$refNNum'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            while ($schl = mysqli_fetch_array($query)){
            $Gender = $schl ['Gender'];
            $regNum = $schl ['RegNumber'];
            $fname=$schl['FirstName'];
             $midName= $schl['MiddleName'];
             $lname = $schl ['Surname'];
             $refNum = $schl ['RefNum'];
             if(!isset($regNum)){
            $stdCode = $_SESSION['regNum'];
             } else {
                 $stdCode =$regNum;
             }
            $dept = $schl ['Departments'];
            $stdPhno =$schl['PhoneNO'];
            $yearOfEntry = $schl['Programme'];
            $faculty = $schl['Schools'];
            $stdEmail = $schl['Email'];
            $StOrigin = $schl['StOrigin'];
            $LGA = $schl['LGA'];
            $Address = $schl['Address'];
            $_SESSION['stdPhno'] = $stPhno;
            $_SESSION['stdEmail']= $stdEmail;
            $_SESSION['fname'] =$fname;
            $_SESSION['midName'] = $midName;
            $_SESSION['lname'] = $lname;
            $_SESSION['dept'] =$dept;
            $_SESSION['yearOfEntry']= $yearOfEntry;
            $_SESSION['faculty'] = $faculty;
            $_SESSION['stdLevel'] = $stdLevel;
            $_SESSION['stdPhno'] = $stdPhno;
                //setcookie('stdEmail', $_SESSION['stdEmail'], time() + (3600), "/");
                //setcookie('pid', $_SESSION['pid'], time() + (3600), "/");
                   }  ?> 


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekiti" />
         <meta name="keywords" content="College Of Health Science And Technology, Ijero-Ekiti. IJERO-EKITI, School Of HEALTH TECHNOLOGY ADMISSION, Registration, Form " />
        <meta name="author" content="College Of Health Sciences and Technology" />
        <title>Eportal-Student || Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        label{font-size:24px; padding:10px; font-family:Arial Black; }
            
        
        </style>
    </head>
    <body >
        <?php include('topbar.php'); ?>
        
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Applicant's PHOTOCARD: <div class="image_inner_container">
					                   &nbsp; &nbsp;  <img src="<?php if(isset($file_path)) { echo $file_path; } else { echo $dfaulti_img; } ?>">
				                    </div>  </h3> </div>
                                     
                                  <div class="small"><h3 class="text-center font-weight-light my-4"><!--Exam Date is Scheduled to :THURSDAY, September 30th, 2021.--> Exam Date Will Be communicated Later<br />
                                       <!-- Time is 8:00 am Prompts || 
                                         Be Punctual--></h3></div>
                                         <!--</div>-->
                                    <div class="card-body">
                                        <div class="form-row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Reference Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="RegNumber" value="<?php echo $refNum; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                        
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Registration Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="RegNumber" value="<?php echo $stdCode; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Student FullName</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php echo $fname . '  '. $midName .'  ' .  $lname ; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Faculty/ School</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php  echo $faculty; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php echo $dept; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Course Of Study</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="signature" value="<?php  echo $dept; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">State Of Origin</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="stOrigin" value="<?php echo $StOrigin; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Local Govt. Area</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="lga" value="<?php  echo $LGA; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Address</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="Addr" value="<?php echo $Address; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Student Phone Numner</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="phno" value="<?php  echo $stdPhno; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Academic Session</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="schlSession" value="<?php echo date('Y'); ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Gender</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="gender" value="<?php  echo $Gender; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Email</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="email" value="<?php echo $stdEmail; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                        
                                    
                                    <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Applicant's Signature</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="HOD" value=""  readonly required />
                                                    </div>
                                                </div>
                                         
                                         <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date Printed</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Sudent Sign" name="signature" value="<?php echo  $mydate[weekday].', '. $mydate[month]. '  ' . $mydate[mday].', '  .$mydate[year]; ?>"  readonly required />
                                                    </div>
                                                </div>
                                               
                                                </div>
                                                <div class="form-row">
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button  type="button" name="printCourseForm" class="btn btn-primary btn-block" onclick="window.print();" style="width:40%;">Print This Page</button></div>
                                             </div>
                                             </div>
                                             
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        
                                        <div class="small"><h3 class="text-center font-weight-light my-4">Mail : admin@escohsti-edu.ng <br />
                                        FOR ENQUIRY PLEASE CONTACT: 08130925149 OR 08038143003</h3></div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="UserdashBoard.php?user=<?php echo $_SESSION['user']; ?>"> >>>Return Back To Dashboard</a></div>
                                    </div>
                                    </div>
                                    </div>
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
<!--            </div>
        </div>
         </div>-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
