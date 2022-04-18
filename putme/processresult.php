<?php
include_once('functions.php');
require_once('connection.php');

 // confirmLogin();
$file_path ="";
$filelocation="";
$stdEmail = "";
if(!$_SESSION['user']){
   header('location:login.php?msg=You Have not logged IN'); 
} 

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
        $matricID =$_SESSION['refNum'];
        $query = "SELECT * FROM onlineApplications WHERE RefNum='$refNum'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            while ($schl = mysqli_fetch_array($query)){
            $Gender = $schl ['Gender'];
            $regNum = $schl ['RegNumber'];
            $fname=$schl['FirstName'];
             $midName= $schl['MiddleName'];
             $lname = $schl ['Surname'];
              $admStatus = $schl ['Acceptance'];
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
                   } 
    if(!empty($admStatus)){
                       echo $admStatus;
                   }
                   
/* if(isset($_POST['resultcheck'])){
    $pin = $_POST['pin'];
    $stdID = user_data($_SESSION['user'], $con);
    $card = checkPin($stdID,$pin,$con);
    if(!empty($card)){
        if($card['pinStatus'] == 'Successful'){
            if($card['pinCounts'] <= 2){
                $num = $card['pinCounts'] + 1;
                 $score = user_score($stdID, $con)['score'];
                 if(!empty($score)){
                     pincountUpdate($stdID,$pin,$num,$con);
                 }
            }else{
                header('location:resultcheck.php?msg=Maximum usage reached (3X), purchase pin to view result!');
            }
        }else{
            header('location:resultcheck.php?msg=Pin Payment not succesful');
        }
    }else{
        header('location:resultcheck.php?msg=Invalid pin entered, purchase pin to view result!');
    }
    
}else{
    header('location:resultcheck.php?msg=method not allowed!');
}*/

if(isset($_POST['resultcheck'])){
    $pin = $_POST['pin'];
    $serialNo = $_POST['serialNo'];
    $stdID = user_data($_SESSION['user'], $con);
    $checkPin = checkPin($pin,$serialNo,$con);
    if(!$checkPin){
        header('location:resultcheck.php?msg=Invalid pin and serial number entered, purchase pin to view result!');
    }elseif($checkPin['userId'] == NULL){
        updateUser_pin($stdID,$serialNo,$pin,$con);
        
    }elseif($checkPin['userId'] != $stdID){
        header('location:resultcheck.php?msg=Pin has already been used by another student, purchase pin to view result!');
    }
    $card = checkPinwithuser($stdID,$serialNo,$pin,$con);
    if(!empty($card)){
        if($card['userId'] == $stdID){
            if($card['pinCounts'] <= 2){
                $num = $card['pinCounts'] + 1;
                 $score = user_score($stdID, $con)['score'];
                 if(!empty($score)){
                     pincountUpdate($stdID,$serialNo,$pin,$num,$con);
                 }
            }else{
                header('location:resultcheck.php?msg=Maximum usage reached (3X), purchase pin to view result!');
            }
        }else{
            header('location:resultcheck.php?msg=Invalid Pin');
        }
    }else{
        header('location:resultcheck.php?msg=Invalid pin entered, purchase pin to view result!');
    }
    
}else{
    header('location:resultcheck.php?msg=method not allowed!');
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
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        label{font-size:24px; padding:10px; font-family:Arial Black; }
            
        
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
                         <a class="dropdown-item" href="photoCard.php">My Slip</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="UserdashBoard.php">Dashboard</a>
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">STUDENT Results Slip</h3> </div>
                                     <div class="text-center card-header">
                                     <img src="<?php if(isset($file_path)){
                                                     echo  $file_path;  } else { echo 'passports/profiles.jpg'; }?>" alt="Avatar" style="width:15%" align="center"  >  </div>
                                        <div class="card-header"><span style="color:green;"><?php if(isset($upd)){ echo  $upd; } ?></span></div>
                                  
                                    <div class="card-body">
                                         <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button  type="button" name="admStatus" class="btn btn-primary btn-block" ><?php if($admStatus ==1){ echo $adm = "Congratulations!," .'<br />'. "You Have Been Provisioned An Admission"; } else { echo "No Admission Has Been Provisioned for You Yet"; } ?></button></div>
                                             </div>
                                        
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Registration Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Your Registration Number" name="RegNumber" value="<?php echo $stdCode; ?>"  readonly required />
                                                    </div>
                                                </div>
                                         
                                         
                                               
                                                </div> 
                                        </form>
                                        <label class="small mb-1" for="inputFirstName">Fullname:</label><?php echo $fname . '  '. $midName .'  ' .  $lname ; ?> <br>
                                        <label class="small mb-1" for="inputFirstName">Reg Number:  </label><?php echo $stdCode; ?><br>
                                        <label class="small mb-1" for="inputFirstName">Course Of Study: </label><?php echo  $dept; ?><br>
                                        <label class="small mb-1" for="inputFirstName">Department: </label><?php echo $dept; ?><br>
                                        <!--<table cellpadding="5" style="text-align:center; border:0.5px solid grey;" border="1">
                                            <th>Matric NO.</th>
                                            <th>FullName </th>
                                            <th>Maths</th>
                                            <th>English</th>
                                            <th>Physics</th>
                                            <th>Chemistry</th>
                                            <th>Biology</th>
                                            <th>Total Score</th>
                                            <th>Average Point</th>
                                                <?php  
                                               /* $tot ="";
                                                $avg="";
                                                $qury=mysqli_query($con,"SELECT * 
                                    FROM    ScreeningResults
                                    Where StudentID ='$regNum' AND Status =0");
                                    while($rs= mysqli_fetch_array($qury)){
                                                $tot = $rs ['TotalScore'];
                                                $avg =$rs ['Average'];
                            $id= $rs ['ID'];
                        //$_SESSION['dpt']= $rs ['Departments'];
                        $std.=  "<tr><td>" .$rs ['StudentID'] . "</td>" .
        "<td>" . $rs['FullName'] ."</td>".
        "<td>".  $rs['Maths'] . "</td>" .
         "<td>" . $rs ['Eng'] . "</td>" .
         "<td>" . $rs ['Chem'] . "</td>" .
         "<td>" . $rs['Phy'] . "</td>" .
          "<td>" . $rs ['Biol'] . "</td>" .
          "<td>" . $rs ['TotalScore'] . "</td>" .
           "<td>" . $rs ['Average'] . "</td>" .
          "</tr>";
                   
                     }echo $std;  */ ?>
                                            
                                        
                                        </table>-->
                                        <label class="small mb-1" for="inputFirstName">Total Score: <?php echo $score;  ?></label><br>
<!--                                        <label class="small mb-1" for="inputFirstName">Average Score: <?php echo $score/4; ?></label>
-->                                        <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Number of times Pin  used: </label><span style="color:black; font-size:14px;"><?php if(isset($num)){ echo  $num; }?> </span><hr /><hr />
                                                
                                                <h2 class="text-center font-weight-light my-4"> PROCEDURE FOR SCREENING</h1><hr />
                                                
                                                <p>This is to inform you that the screening exercise would commence on Tuesday, 12th
- Friday, 15th October 
2021. Therefore, you are requested to come along with the following: <br />
<hr />
 i. Photocard (Application form).<br />

ii.Entrance Examination Result print-out indicating your scores<br />
ii. Original copy of your credentials. <br />
iii. four (4) photocopies each of your credentials. <br />
iv. Payment Receipt of Acceptance fee of Twenty-Five Thousand Naira (N25,000) only payable on the 
College portal. <br />
 Thank you <br /><hr />
SIGNED. <br />
College Management. 

</p>.                                            </div>
                                        <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button  type="button" name="printAdmForm" class="btn btn-primary btn-block" onclick="window.print();" style="width:40%;">Print Results Slip</button></div>
                                             </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="UserdashBoard.php?user=<?php echo $_SESSION['user']; ?>"> >>>Return Back To Dashboard</a></div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
