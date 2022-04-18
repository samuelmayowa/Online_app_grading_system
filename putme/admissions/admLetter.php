<?php
include_once('../functions.php');
require_once('../connection.php');
/*function confirmScores($con){*/
    $query=mysqli_query($con,"Select * From applicationResults");
    $adm=mysqli_num_rows($query)==1;
    
/*}*/
  confirmLogin();
$file_path ="";
$filelocation="";
$stdEmail = "";
if(!$_SESSION['user']){
   header('location:login.php?msg=You Have not logged in'); 
} 

if(isset($_GET['msg'])){
    $upd= $_GET['msg'];
}
$amount="";
 $query ="SELECT Amount FROM paymentCategories WHERE payCategories LIKE 'Acceptance%'";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
    while ($results = mysqli_fetch_array($query)){
        $amount=  $results ['Amount'];
       if(!empty($amount)){
       $_SESSION['amt'] =$amount;
       } else {
            $amount ="#25,000.00";
       }
        
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
        $adm = "";
        $matricID =$_SESSION['refNum'];
        $query = "SELECT * FROM onlineApplications WHERE RefNum='$refNum'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            while ($schl = mysqli_fetch_array($query)){
            $Gender = $schl ['Gender'];
            $regNum = $schl ['RegNumber'];
            $fname=$schl['FirstName'];
             $midName= $schl['MiddleName'];
             $lname = $schl ['Surname'];
             $user = $schl ['UsernameSurname'];
              $admStatus = $schl ['Acceptance'];
             if(!isset($regNum)){
            $stdCode = $_SESSION['regNum'];
             } else {
                 $stdCode =$regNum;
             }
             //$adm = $schl ['Acceptance'];
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
                   /*if($adm !=1){
                       header('location:../myAdmission.php?msg=You have not beeen provisioned Admission');
                   }*/
                   
                    
$is_admission=checkadmission($con,$regNum);
                                                
if($is_admission != $regNum){
    header('location:https://applications.escohsti-edu.ng/UserdashBoard.php?user='.$user .' && adm=You have Not Paid For The  Admission That Has Been Provissioned for You Yet'); 
    
}
    

        
                // Get Admited Candidate
                
                $query = "SELECT * FROM admissions WHERE RegNumber='$regNum'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            $adm = mysqli_fetch_assoc($query);
            $course=$adm['course'];
            if(empty($course)){
               // $course =$dept;
               
            } else{
                $course=$adm['course'];
            }
            // Get Department Name 
            $query = "SELECT * FROM Departments WHERE DeptID='$course' OR DeptName='$course'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            $dp = mysqli_fetch_assoc($query);
            $dpt=$dp['DeptName'];
            $school = $dp['FacultyID'];
            $dur = $dp['course_duration'];
            $dept= $dp['DeptID'];
           // echo "<script> window.alert('$dept');</script>";
           
           //===== GET School Fees ==================
           if($StOrigin == 'ekiti'){
               $citizen='INDIGENE';
           }else{
               $citizen ='NON-INDIGENE';
           }
          /* $query = "SELECT * FROM schoolfees  WHERE course='$course' OR course='$dept' AND citizenship='$citizen'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            $dp = mysqli_fetch_assoc($query);
            $fees=$dp['fees'];*/
            
            //Get Fees Matched course Offered
            
             $query = "SELECT * FROM paymentCategories  WHERE Department='$course'  AND Citizenship='$citizen'";
        $query = mysqli_query($con, $query) or die (mysqli_error($con));
            $dp = mysqli_fetch_assoc($query);
            $fees=$dp['Amount'];
            
                   ?> 


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        label{font-size:24px; padding:10px; font-family:Arial Black; }
            .image_inner_container img{
       	height: 80px;
       	width: 80px;
       	border-radius: 50%;
       	border: 5px solid white;
       }
       .container{
       	height: 100%;
       	align-content: center;
       }

       /*.image_outer_container{*/
       /*	margin-top: auto;*/
       /*	margin-bottom: auto;*/
       /*	border-radius: 50%;*/
       /*	position: relative;*/
       /*}*/
       h3{
           color:maroon;
       }  
        
         
         img {
    pointer-events: none;
}
        </style>
    </head>
    <body>
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
                         <a class="dropdown-item" href="../photoCard.php">My Slip</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../UserdashBoard.php">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></div>
                                    
                                    <!--<div class="card-header"><h3 class="text-center font-weight-light my-4">Applicant Admission Notication</h3> </div>-->
                                     
                                        <div class="card-body">
                                        <div class="form-row">
                                                 <h5 class="text-left font-weight-light my-4">
                                                   <label class="small mb-1" for="inputFullName">Rgistration Number: <?php echo $stdCode; ?></label><br />
                                                   <label class="small mb-1" for="inputFullName"><?php $fn=""; echo $fn=strtoupper($fname. ' '.  $midName. ' '. $lname); ?></label><br />
                                                   <!--<label class="small mb-1" for="inputFullName">--> <?php //echo ucwords($Address); ?><!--</label><br />-->
                                                    <label class="small mb-1" for="inputFullName"><?php echo ucwords($LGA); ?>,</label><br />
                                                    <label class="small mb-1" for="inputFullName"><?php echo ucwords($StOrigin); ?>.</label><br />
                                                </h5>
                                                 
                                         
                                                 <h3 class="text-right font-weight-light my-12 image_inner_container">
                                                    <img src="../<?php if(isset($file_path)){
                                                     echo  $file_path;  } else { echo 'passports/profiles.jpg'; }?>" alt="Avatar"  align="center"  > 
                                                </h3>
                                                </div>
                                                <div class="form-row">
                                                    
                                                     <label class="small mb-1" for="inputFullName"  style="width:100%;">Dear Mr./Mrs/Miss:  <?php  echo "\t". strtoupper($fname. ' '.  $midName. ' '. $lname); ?>,</label>
                                                   <!-- <label class="small mb-1" for="inputFullName" style="width:100%;"> Rgistration Number:</label> <hr />--> <br>
                                                   </div>
                                                   <div class="card-header"><h3 class="text-center font-weight-light my-4">
                                                    <h4 class="text-center font-weight-light my-12">OFFER OF PROVISIONAL ADMISSION FOR 2021/2022 ACADEMIC SESSION</h4></div><br>
                                                    <div class="form-row">
                                                    <p class="text-left font-weight-light my-4">With reference to your application for admission and subsequent interview you attended at 
                                                    the COLLEGE OF HEALTH SCIENCES & TECHNOLOGY, IJERO-EKITI, EKITI STATE, NIGERIA,
                                                    I am pleased to inform you that you have been offered a provisional admission into the College for the 2021/2022 ACADEMIC SESSION to
                                                    study  <label class="small mb-1" for="inputFullName"><?php echo $dpt; ?> </label> Course 
                                                    leading to the award of Diploma/Certificate for  <label class="small mb-1" for="inputFullName"><?php echo $dpt; ?> .</label><br>
                                                    1.	MODE OF ENTRY: Entrance Examination<br>
                                                    2.	COURSE OFFERED: <label class="small mb-1" for="inputFullName"><?php if(!empty($course)){ echo $dpt; } else { echo $dept; } ?> .</label><br>
                                                    3.	SCHOOL: <label class="small mb-1" for="inputFullName"><?php if(!empty($school)){  echo $school; }else { echo $dept; ; } ?> .</label><br>
                                                    4.	DURATION: <label class="small mb-1" for="inputFullName"><?php echo $dur.  '  Years'; ?> .</label><br>
                                                    5.	STATE OF ORIGIN: <label class="small mb-1" for="inputFullName"><?php echo $StOrigin; ?> .</label><br>
                                                    6.	FEES: <label class="small mb-1" for="inputFullName">#<?php echo $fees; ?> .</label><br>

                                                 </p>
                                                 <p class="text-left font-weight-light my-4">
                                                   <table width="70%" align="center"> 
                                                     <tr> <td>100 LEVEL</td>						<td>INDIGINE </td>	    <td>NON - INDIGINE</td></tr>

                                                                <tr><td>PARTICULARS	</td>				    <td> N</td>			    <td> N</td></tr>
                                                               <tr><td> A.	ACCEPTANCE FEE	</td>			<td>25,000.00</td>	<td>25,000.00</td>	</tr>
                                                                	
                                                                <tr><td colspan="3">B.	COMPULSORY PAYMENTS	</td></tr>
                                                                <tr><td> i.	HOSTEL ACCOMMODATION</td>			<td>			25,000.00</td>			<td>		25,000.00.</td></tr>    
                                                                <tr><td> ii.            MEDICAL 	</td>			<td>				15,000.00</td>			<td>		15,000.00</td></tr>
                                                                 <tr><td>iii.	UNIFORM				</td>			<td>	15,000.00</td>			<td>		15,000.00</td></tr>
                                                                 <tr><td>iv.	INDEXING					</td>			<td>20,000.00</td>			<td>		20,000.00</td></tr>
                                                                <tr><td><label class="small mb-1" for="inputFullName">	SUB-TOTAL</label></td>
                                                                <td><label class="small mb-1" for="inputFullName">75,000.00</label></td><td><label class="small mb-1" for="inputFullName">		75,000.00</label></td></tr>
                                                                	
                                                                <tr><td>C. 	TUITION:					
                                                                	CATEGORIES</td></tr>
                                                               <tr><td> a.	CHEW, PHARMARCY, MEDICAL  LAB,  X-RAY 
                                                                HIM TECHNICIAN, AND DOP	</td>		<td>115,000.00</td>		<td>125,000.00</td></tr>
                                                               <tr><td> b.	HIM TECH, CHEW TECH, EHT,
                                                                DENTAL TECHNICIAN, BME, PARAMEDICS
                                                                AND ORTHOPEADIC PLASTERING.	</td>	<td>100,000.00</td>		<td>110,000.00</td></tr>
                                                                <tr><td>c.	HUND, EVT, COMPUTER, EHA
                                                                PUBLIC HEALTH TECHNICIAN, 
                                                                FOOD HYGIENE, PHN,
                                                                HEALTH EDUCATION, OCCUPATIONAL 
                                                                HEALTH AND SAFETY. J-CHEW	</td><td>	95,000.00</td>		<td>		105,000.00</td></tr>
                                                                         
                                                                <tr><td colspan="3">i.	Category A	</td></tr>
                                                                <tr><td>60% Part Payment</td><td>69,000.00</td><td>		75,000.00</td></tr>
                                                               <tr><td> 40% Part Payment</td><td>				46,000.0</td><td>50,000.00</td></tr>		
                                                                <tr><td>ii.	Category B.	</td></tr>				
                                                               <tr><td> 60% Part Payment</td><td>				60,000.00</td><td>		66,000.00</td></tr>
                                                                <tr><td>40% Part Payment</td><td>				40,000.00</td><td>		44,000.00</td></tr>
                                                                <tr><td>iii.	Category C</td></tr>
                                                               <tr><td> 60% Part Payment</td><td>				57,000.00</td><td>		63,000.00</td></tr>
                                                               <tr><td> 40% Part Payment</td><td>				38,000.00</td><td>		42,000.00</td></tr>
                                                               </table>

                                                 </p>
                                                 <p class="text-left font-weight-light my-4">
                                                     02.	Students should note that they shall pay the above tuition fee annually throughout the duration of the programme.<br>

03.	I wish to add that this offer of admission is subject to the following conditions:<br>

i.	All fees should be dully paid online through College Portal and receipt obtained and verified by the Bursary Office of the College before proceeding for registration as a student.<br>

ii.	The acceptance fee must be paid within two (2) weeks, otherwise the offer of provisional of admission shall be forfeited.<br>

iii.	The payments in A and B above must be paid before you will be allowed for central screening and online registration.<br>

04.	You are to report at the Admission Office for central registration with your original certificates after the payment of the acceptance fee and <label class="small mb-1" for="inputFullName">Seventy Five Thousand Naira (#75,000.00)</label> for Hostel Accommodation,<br> 
Medical Test, Uniform and Indexing with your Admission letter and Medical Certificate from the COLLEGE OF HEALTH SCIENCES & TECHNOLOGY Health Centre within fourteen (14) days.<br>

05.	Photocopies of all credentials including a letter from a Guarantor should be submitted to the Admission Office of the College.<br>

06.	You are to thereafter, proceed with a clearance obtained from Admission office to your School and department for further registration respectively.<br>

07.	Registered Students shall be presented for Probation/Weeding and Mid-semester exam within 3 months of resumption and if found unsuitable, will be advised to withdraw without any refund of any payment.<br>

08.	Any Student found pregnant during the course of study will be asked to withdraw from the College with immediate effect.<br>

09.	Students shall pay the cost of their industrial training, practicals, books, study equipment, departmental activities, and accreditation levy and pay all Professional Councils/Boards Charges.<br>

10.	Other Materials to be submitted include:<br>
1.	Six (6) copies of passport sized photograph,<br>
2.	Four (4) photocopies of each statement of result or certificate,<br>
3.	Four (4) photocopies of admission letter<br>
4.	Four (4) photocopies of Birth Certificate or Declaration of age<br>
5.	Four (4) photocopies of Marriage certificate if applicable.<br>

11.	You are advised to bring along your laptop dully registered with the College Security while resuming.<br>

12.	You will be guided by your HOD on how to proceed on course registration online while lectures start in accordance with academic calendar displayed on the portal and notice Boards.<br>

13.	It should be noted that if it is discovered hereafter that you do not possess any of the qualifications on which the offer of admission was granted, you will be required to withdraw from the program with immediate effect.<br>

14.	Accept my congratulations.<br>

                                                 </p>
                                                </div>

                                                
                                                <div class="form-row">
                                                   
                                                <p align="center">
                                                    
                                                  Sincerely,
                                                  <br><br />
                                                  <label class="small mb-1" for="inputFirstName"><img src='registrar-chst.png' > </label><br />
                                                  <label class="small mb-1" for="inputFirstName">C.A Ogunsakin.</label><br>
                                                 </label> Registrar.</label><br />
                                                  <br />
                                                  </label>Ekiti State College of Health Sciences and Technology.</label>
                                                </p>
                                                </div>
                                               <div class="form-row">
                                                
                                                </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-1"><button  type="button" name="printLetter" class="btn btn-primary btn-block" onclick="window.print();" >Print Admission Letter</button></div>
                                             </div>
                                             </div>
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date Printed</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Sudent Sign" name="signature" value="<?php echo  $mydate[weekday].', '. $mydate[month]. '  ' . $mydate[mday].', '  .$mydate[year]; ?>"  readonly required />
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                       <label class="small mb-1" for="inputFirstName"> Mail : admin@escohsti-edu.ng
                                        Call: +(234) 08068430751</label>
                                        <div class="small"><a href="../UserdashBoard.php?user=<?php echo $_SESSION['user']; ?>"> >>>Return Back To Dashboard</a></div>
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
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti, PMB 316, Epe-Ijero Road, Ijero-Ekiti, Ekiti State, Nigeria 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
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
