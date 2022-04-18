<?php
require('connection.php');
session_start();
$resp="";
$courseCode="";
$appsx="";


// Get News and Notifications 

function getNews($con){
    
    $query=mysqli_query($con,"SELECT * FROM portalNews Where newsBody !=0 AND forWhom='Admission' order by publishedDate, lastModified ASC");
    $fetchnews = mysqli_fetch_assoc($query);
   return $fetchnews;
}

// ========= Build News Portal =====

function getNws($con){
    
    $query=mysqli_query($con,"SELECT * FROM portalNews Where  forWhom='Admission' order by publishedDate, lastModified DESC");
    while($fetchnws = mysqli_fetch_assoc($query)){
  $nw.= $fetchnws ['newsTitle'] . "<br /> " .
         $fetchnws['newsBody'] .  "<br />" .
         "<code>". $fetchnws ['publishedDate'] . "</code><br />".
         "Publish By: <code>". $fetchnws ['staffCode'] . "</code><br /><hr />";
}
return $nw;
}

//========== Check if Results Uploaded for STudent============
function checkResults($con,$regnum){
   
    $inv =mysqli_query($con,"SELECT * From applicationResults Where RegNumber ='$regnum'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($invs=mysqli_fetch_array($inv)){
           return $invs=$invs['RegNumber'];
        }
    }
    
}


// ========== Check if Admission is given to the Applicant===========

function checkadmission($con,$regnum){
   
    $inv =mysqli_query($con,"SELECT * From admissions Where RegNumber ='$regnum'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($invs=mysqli_fetch_array($inv)){
           return $invs=$invs['RegNumber'];
        }
    }
    
}

// ========== Check if Acceptance Invoice is generated NOT Paid for  the Applicant===========

function checkisacceptgenerated($con,$user){
   
    $inv =mysqli_query($con,"SELECT * From Invoices Where StudentID =(Select ID From userAccounts Where Username=(Select Username from onlineApplications Where Username='$user' AND ServiceType='2021/2022 Acceptance Fee' AND InvoiceStatus ='Payment reference generated'))");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($acptGen=mysqli_fetch_array($inv)){
           return $acptGen=$acptGen['InvoiceStatus'];
        }
    }
    
}


// Confirm IF Invoice Is Generated 
function confirmInvoice($con,$stdID){
   
    $inv = mysqli_query($con,"SELECT * From Invoices Where StudentID ='$stdID'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        return $inv;
    }
    
}
/*function confirmLogin (){
    if(!$_SESSION['userID']){
   return header('location:index.php?msg=You Must LogIn First');
}
}
*/
$usid="";
$id="";
 //Get Id of Applicants To Edit
 function getApplicants_Id($con,$refNum){
	$query =mysqli_query($con, "SELECT ID From onlineApplications Where RefNum ='$refNum'");
	while($usid=mysqli_fetch_array($query)){
	    $id=$usid['ID'];
	}
	return $id;
 }
	  //Get All Applicants Details
 function getApplicantDetails($con, $id){
	$query =mysqli_query($con, "SELECT * From OnlineApplications Where ID ='$id'");
	if(!$query){
	$msg = "Unable To Perform your Transaction".mysqli_error($con);
	}else{
	  $appl=mysqli_fetch_assoc($query);
	      
	  }
	  return $appl;
 }
 
 
//Confirm Credentials Status :

function getCredStatusWithRRR($rrr,$regNum, $con){
    
    $query=mysqli_query($con,"SELECT * FROM Credentials WHERE  RefNumber = '$rrr' AND RegNumber = '$regNum'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

//Confirm Passport  Status :

function getPassportStatusWithRRR($stdID, $rrr,$statu,$con){
    
    $query=mysqli_query($con,"SELECT * FROM OnlineApplications WHERE ID ='$stdID' AND RefNum = '$rrr' AND Status = '$statu'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

//  Get Invoice Details 
function getInvoice($con,$stdID){
   
    $inv =mysqli_query($con,"SELECT * From Invoices Where StudentID ='$stdID'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($invs=mysqli_fetch_array($inv)){
           return $invs;
        }
    }
    
}


// Save Generated Invoice
function saveInvoice($stdID,$amount,$payingFor,$orderID,$refNNum,$status,$con){
    
    $query=mysqli_query($con,"INSERT INTO Invoices(StudentID,ServiceType,Amount,RefNum, RefOrderID, InvoiceStatus) VALUES('$stdID','$payingFor','$amount','$refNNum','$orderID','$status')");
    if(!$query){
        return mysqli_error($con);
    }else{
        $msg="Invoice Created Successfully";
    
    }
    return $msg;
}

// Save Generated Invoice
function savePUTMEInvoice($stdID,$amount,$orderID,$refNNum,$status,$email,$con){
    $update = "UPDATE `jamb_data` SET `RRR` = '$refNNum', `order_id` = '$orderID', `status` = '$status', `amount` = '$amount', `std_email` = '$email' WHERE `RG_NUM` = '$stdID'";
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
      
    $msg = "Data Updated Sucessfully";
    }
    return $msg;
    
}

function savepinInvoice($stdID,$pin,$rrr,$count,$status,$orderId,$con){
    
    $query=mysqli_query($con,"INSERT INTO scratchCards(userId,pinHash,RRR,pinCounts, pinStatus, orderID) VALUES('$stdID','$pin','$rrr','$count','$status','$orderId')");
    if(!$query){
        return mysqli_error($con);
    }else{
        $msg="Invoice Created Successfully";
    
    }
    return $msg;
}

function savepinSerialNo($pin,$serialNo,$count,$status,$con){
    
    $query=mysqli_query($con,"INSERT INTO scratchCards (pinHash,serialNo,pinCounts, pinStatus) VALUES('$pin','$serialNo','$count','$status')");
    if(!$query){
        return mysqli_error($con);
    }else{
        $msg="Invoice Created Successfully";
    
    }
    return $msg;
}

function pincheck($pin, $con){
    $inv =mysqli_query($con,"SELECT * From scratchCards Where pinHash ='$pin'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($invs=mysqli_fetch_array($inv)){
           return $invs;
        }
    }
}

function serialcheck($serialNo, $con){
    $inv =mysqli_query($con,"SELECT * From scratchCards Where serialNo ='$serialNo'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($invs=mysqli_fetch_array($inv)){
           return $invs;
        }
    }
}
// get  with oderId and rrr
function getDoubleData($stdID,$rrr,$con){
    
    $query=mysqli_query($con,"SELECT * FROM scratchCards WHERE userId ='$stdID' AND RRR = '$rrr' ");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}
// get  with oderId and rrr
function checkPin($pin,$serialNo,$con){
    
    $query=mysqli_query($con,"SELECT * FROM scratchCards WHERE serialNo ='$serialNo' AND pinHash = '$pin' ");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}
// get  with oderId and rrr
function checkPinwithuser($stdID,$serialNo,$pin,$con){
    
    $query=mysqli_query($con,"SELECT * FROM scratchCards WHERE serialNo ='$serialNo' AND userId ='$stdID' AND pinHash = '$pin' ");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

function user_data($username, $con){
    $inv =mysqli_query($con,"SELECT * From onlineApplications Where Username ='$username'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($invs=mysqli_fetch_assoc($inv)){
           return $invs['RegNumber'];
        }
    }
}
function Alluser_data($username, $con){
    $inv =mysqli_query($con,"SELECT * From onlineApplications Where Username ='$username'");
    if(!$inv){
        return mysqli_error($con);
    }else{
       
           return mysqli_fetch_assoc($inv);
    }
}

function user_score($stdID, $con){
    $inv =mysqli_query($con,"SELECT * From applicationResults Where RegNumber ='$stdID'");
    if(!$inv){
        return mysqli_error($con);
    }else{
       
           return mysqli_fetch_assoc($inv);
    }
}
function updateUser_pin($stdID,$serialNo,$pin,$con){
     $update = "UPDATE `scratchCards` SET `userId` = '$stdID' WHERE `serialNo` = '$serialNo' AND  `pinHash` = '$pin'";
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        //$msg = "Invoice Updated Sucessfully"." ".$stdID." ".$amount." ".$payingFor." ".$orderID." ".$refNNum." ".$statuspaid." ".$datapaid;
    $msg = "Data Updated Sucessfully";
    }
    return $msg;
}

function pincountUpdate($stdID,$serialNo,$pin,$num,$con){
    $update = "UPDATE `scratchCards` SET `pinCounts` = '$num' WHERE `serialNo` = '$serialNo' AND `userId` = '$stdID' AND `pinHash` = '$pin'";
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        //$msg = "Invoice Updated Sucessfully"." ".$stdID." ".$amount." ".$payingFor." ".$orderID." ".$refNNum." ".$statuspaid." ".$datapaid;
    $msg = "Pin Updated Sucessfully";
    }
    return $msg;
}
function updatePin($stdID,$rrr,$statuspaid,$datepaid,$con){
   $update = "UPDATE `scratchCards` SET `pinStatus` = '$statuspaid', `date` = '$datepaid' WHERE `userId` = '$stdID' AND `RRR` = '$rrr'";
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        //$msg = "Invoice Updated Sucessfully"." ".$stdID." ".$amount." ".$payingFor." ".$orderID." ".$refNNum." ".$statuspaid." ".$datapaid;
    $msg = "Invoice Updated Sucessfully";
    }
    return $msg;
}

// ====================== update status With Erro Not Redirecting==============
/*function updateInvoice($stdID,$amount,$payingFor,$orderID,$refNNum,$statuspaid,$datapaid,$con){
   //$update = "UPDATE `Invoices` SET `InvoiceStatus` = '$statuspaid', `DatePaid` = '$datapaid' WHERE `StudentID` = '$stdID' AND `RefNum` ='$refNNum'";
   if($payingFor =="2021/2022 Acceptance Fee"){
       $query=mysqli_query($con,"SELECT * FROM userAccounts WHERE ID ='$stdID' ");
       $fetchdata = mysqli_fetch_assoc($query);
       $username = $fetchdata['Username'];
       $update = "UPDATE `onlineApplications` SET Acceptance = 1 WHERE `Username` = '$username'";
   }
    //$update = "UPDATE `Invoices` SET `InvoiceStatus` = '$statuspaid', `DatePaid` = '$datapaid' WHERE `StudentID` = $stdID AND `ServiceType` = '$payingFor' AND `RefNum` = $refNNum AND `RefOrderID` = $orderID ";
    //$update = "UPDATE `Invoices` SET `InvoiceStatus` = '.$statuspaid.', `DatePaid` = '.$datapaid.' WHERE `StudentID` = '.$stdID.' AND `RefNum` = '.$refNNum.' AND `RefOrderID` = '.$orderID.' ";
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        $update = "UPDATE `Invoices` SET `InvoiceStatus` = '$statuspaid', `DatePaid` = '$datapaid' WHERE `StudentID` = '$stdID' AND `RefNum` ='$refNNum'";
        $query=mysqli_query($con, $update);
        if(!$query){
        return mysqli_error($con);
    }elseif($query){
        //$msg = "Invoice Updated Sucessfully"." ".$stdID." ".$amount." ".$payingFor." ".$orderID." ".$refNNum." ".$statuspaid." ".$datapaid;
    $msg = "Invoice Updated Sucessfully";
    }
    return $msg;
}
}*/


//================  Old Update Invoice ==============

function updateInvoice($stdID,$amount,$payingFor,$orderID,$refNNum,$statuspaid,$datapaid,$con){
   $update = "UPDATE `Invoices` SET `InvoiceStatus` = '$statuspaid', `DatePaid` = '$datapaid' WHERE `StudentID` = '$stdID' AND `RefNum` ='$refNNum'";
   $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        if($payingFor =="2021/2022 Acceptance Fee"){
            $query44=mysqli_query($con,"SELECT * FROM userAccounts WHERE ID ='$stdID' ");
            $fetchdata = mysqli_fetch_assoc($query44);
            $username = $fetchdata['Username'];
            $update1 = "UPDATE `onlineApplications` SET Acceptance = 1 WHERE `Username` = '$username'";
            $query1=mysqli_query($con, $update1);
        }elseif($payingFor =="2021/2022 Compulsory Fee"){
           $query22=mysqli_query($con,"SELECT * FROM userAccounts WHERE ID ='$stdID' ");
           $fetchdata = mysqli_fetch_assoc($query22);
           $username = $fetchdata['Username'];
           
           //select student data
           $query7=mysqli_query($con,"SELECT * FROM onlineApplications WHERE `Username` = '$username' ");
           $fetchdata1 = mysqli_fetch_assoc($query7);
           $f_name = $fetchdata1['FirstName'];
           $m_name = $fetchdata1['MiddleName'];
           $s_name = $fetchdata1['Surname'];
           $phone = $fetchdata1['PhoneNO'];
           $email = $fetchdata1['Email'];
           $programme = $fetchdata1['Programme'];
           $dateofbirth = $fetchdata1['BirthDate'];
           $storigin = strtoupper($fetchdata1['StOrigin']);
           $gender = $fetchdata1['Gender'];
           $lga = $fetchdata1['LGA'];
           $address = $fetchdata1['Address'];
           $username = $fetchdata1['Username'];
           $reg = $fetchdata1['RegNumber'];
           $id_no = sprintf("%04d",$fetchdata1['ID']);
           if(strtolower($storigin) == 'ekiti'){
               $citizen = 'INDIGENE';
           }else{
               $citizen = 'NON-INDIGENE';
           }
           
           //select department given admission to
           $query2=mysqli_query($con,"SELECT * FROM admissions WHERE `RegNumber` = '$reg' ");
           $fetchdata2 = mysqli_fetch_assoc($query2);
           $course = $fetchdata2['course'];
           
           //select department and facluty 
           $query3=mysqli_query($con,"SELECT * FROM Departments WHERE `DeptID` = '$course' ");
           $fetchdata3 = mysqli_fetch_assoc($query3);
           $department = $fetchdata3['DeptName'];
           $department=ucwords($department);
           $deptID= $fetchdata3['ID'];
           $faculty = $fetchdata3['FacultyID'];
           $y=date("Y");
            $yr=date("Y")+1; 
            //$y=date("Y"); echo $y .'/';  $d=date("Y"); echo $d+=1; 
            $ses_cal=$y.'/'. $yr; 
            $adminKey=sha1('admin@ijero123#');
           $reg_no = 'CHT/21/'.$course.'/'.$id_no;
           
           $queryCheck=mysqli_query($con,"SELECT * FROM students WHERE studentEmail ='$email' ");
           $fetchdataCheck = mysqli_num_rows($queryCheck);
           if($fetchdataCheck == 0){
               $queryrr=mysqli_query($con,"INSERT INTO students (matricNumber,firstName,middleName,lastName,yearOfEntry,stateOfOrigin,studentLevel,department,department_id,faculty,programme,studentEmail,stdPhoneNumber,Gender,ContactAddr,LGA,Citizenship,passKey,adminKey,AcademicSession) VALUES('$reg_no','$f_name','$m_name','$s_name','2021','$storigin', '100','$department','$deptID','$faculty','$programme','$email','$phone','$gender','$address','$lga','$citizen','password1','$adminKey', '$ses_cal')");
                if(!$queryrr){
                    return mysqli_error($con);
                }
           }
       }
        //$msg = "Invoice Updated Sucessfully"." ".$stdID." ".$amount." ".$payingFor." ".$orderID." ".$refNNum." ".$statuspaid." ".$datapaid;
    $msg = "Invoice Updated Sucessfully";
    }
    return $msg;

}

function updatePUTMEInvoice($stdID,$amount,$orderID,$refNNum,$statuspaid,$datapaid,$con){
   $update = "UPDATE `jamb_data` SET `status` = '$statuspaid', `DatePaid` = '$datapaid' WHERE `RG_NUM` = '$stdID' AND `RRR` ='$refNNum'";
   
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        $msg = "Invoice Updated Sucessfully";
        return $msg;
    }
}


// get  with type
function getinvoiceWithType($stdID,$status,$type,$con){
    
    $query=mysqli_query($con,"SELECT * FROM Invoices WHERE StudentID ='$stdID' AND InvoiceStatus = '$status' AND ServiceType = '$type'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

// get  with type
function getPUTMEinvoice($stdID,$status,$con){
    
    $query=mysqli_query($con,"SELECT * FROM jamb_data WHERE RG_NUM ='$stdID' AND status = '$status'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

// get  with oderId and rrr
function getinvoiceWithOrderidAndRRR($stdID,$rrr,$oderID,$con){
    
    $query=mysqli_query($con,"SELECT * FROM Invoices WHERE StudentID ='$stdID' AND RefNum = '$rrr' AND RefOrderID = '$oderID'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

// get  with oderId and rrr
function getPUTMEinvoiceWithOrderidAndRRR($stdID,$rrr,$oderID,$con){
    
    $query=mysqli_query($con,"SELECT * FROM jamb_data WHERE RG_NUM ='$stdID' AND RRR = '$rrr' AND order_id = '$oderID'");
    $fetchdata = mysqli_fetch_array($query);
   return $fetchdata;
}


function getuserdata($user_id,$con){
    
   $query = mysqli_query($con, "SELECT * FROM userAccounts Where ID ='$user_id'");
    $fetchuserdata = mysqli_fetch_assoc($query);
   return $fetchuserdata;
}
// Check If Application Exists For a user

function getAppx($con,$user){
    //$courseID=$courseCode;
    $apx =mysqli_query($con,"SELECT RegNumber From onlineApplications Where Username ='$user'");
    if(!$apx){
        return mysqli_error($con);
    }else{
        $appsx ="";
        while($appxs=mysqli_fetch_array($apx)){
            $appsx=$appxs['RegNumber'];
        }
    }
    return $appsx;
}

 function apiCredential($id, $key){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $data = mysqli_query($con,"SELECT * from ApiCredentials where ID ='$id'");
    $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata[$key];
}

function ServiceTypeID($ser_id, $key){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $data = mysqli_query($con,"SELECT * from ServiceTypeIDs where ID ='$ser_id'");
    $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata[$key];
}

function getCode($con,$courseCode){
    $courseID=$courseCode;
    $cCode =mysqli_query($con,"SELECT CourseCode From CourseCodes Where Id =".$courseID);
    if(!$cCode){
        return mysqli_error($con);
    }else{
        while($CourseCode=mysqli_fetch_array($cCode)){
            $courseCode=$CourseCode['CourseCode'];
        }
    }
    return $courseCode;
}


//Get Application Detaiils
function aplDetails($user, $passkey){
    $query = "Select FirstName, MiddleName, Surname, Email, PoneNO FROM onlineApplications WHERE Username='$user' AND password = '$passkey'";
    $query=mysqli_query($con,$query);
    if(!$query){
      return  mysqli_error($con);
    }
    else{
        while($results=mysqli_fetch_array($query)){
            $fn=$results['FirstName'];
            $midname=$results['MiddleName'];
            $sn=$results['Surname'];
            $email=$results['Email'];
            $phno=$results['PoneNO'];
        }
    }
    return $email;
}


//GetApplixation


function getPayId($con,$userID){
   
    $userId=$userID;
$pay=mysqli_query($con,"Select RefNumber From studentPayments Where matricID ='$userId'");
while($payCode=mysqli_fetch_array($pay)){
    $payID =$payCode ['RefNumber'];
}


return $payID;
}


function mysql_escape_mimic($inp) {
    if(is_array($inp))
        return array_map(__METHOD__, $inp);

    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }

    return $inp;
} 

function mysql_fix_string($string){
    if(get_magic_quotes_gpc())
        $string = stripslashes($string);
        return mysql_real_escape_string($string);
}

function mysql_entities_fix_string(){
    return htmlentities(mysql_fix_string($string));
}

function sanitizeString($string){
    $string = stripslashes($string);
    $string = htmlentities($string);
    $string = strip_tags($string);
    return $string;
}
function sanitizeMySQL($string){
    $string = mysql_real_escape($string);
    $string = sanitizeString($string);
    return $string;
}

function confirmLogin (){
    if(!$_SESSION['userID']){
   return header('location:index.php?msg=You Must LogIn First');
}
}
function confirmAppUser (){
    if(!$_SESSION['userID'] || !isset($_SESSION['user'])){
   return header('location:login.php?msg=You Have not been Authenticated yet');
}
}
function confirmPswd() {
    if(isset($_SESSION['pid'])){
    $pwd='password1';
    if($pwd == $_SESSION['pid']){
       return header('location:password.php');
       
    }
}
}

function getCourseCode($con){                                    $schlID ='';
                                                            $query = "SELECT CourseCode, CourseTitle FROM Courses";
                                                            $query = mysqli_query($con, $query);
                                                            if($query){ return mysqli_error($con);
                                                            } else{
                                                            while ($schl = mysqli_fetch_array($query,$con)){
                                                                $schlID = $schl ['CourseCode'];
                                                               $schools = $schl ['CourseTitle'];
                                                               return $schools .= "<option value='$schools'>$schlID ". '  '. "($schools)</option>";
                                                               } 
                                                            }
                                                           
}

function getStd($fileName){
    if(isset($fileName)){
     require_once("../connection.php");
    include("SimpleXLSX.php");
        if($con){
        //echo "Hi You Are Connected";
        $std=SimpleXLSX::parse($_FILES['std']['tmp_name']);
        echo "<pre>"; 
        //print_r($std->rows(1));
        print_r($std->dimension(2));
        print_r($std -> sheetNames());
        for($sheet=0; $sheet < sizeof($std->sheetNames()); $sheet++){
            $rowcol =$std->dimension($sheet);
        $i=0;
        if($rowcol[0]!=1 && $rowcol[1]!=1){
        foreach ($std->rows($sheet) as $key => $row){
           // print_r($row);
            $q="";
            foreach ($row as $key => $cell){
               // echo $cell; echo "<br>";
                if($i==0){
                    $q.=$cell." Varchar(50),";
                    
                } else {
                    $q.="'".$cell ."',";
                    
                }
            }
            if($i==0){
            $query = "CREATE Table ". $std->sheetName($sheet)."(".rtrim($q,",").");"; 
            }else {
            $query = "INSERT INTO " .$std->sheetName($sheet)." Values (".rtrim($q,",").");";
            }
            echo $query; 
            if(mysqli_query($con,$query)){
                echo "imported";
            }
            echo "<br>";
            echo "<br />";
             $i++;
        }
        
    }
}
}
}
}
        
function getCourses($con,$stdM){
   $stdEmai ="";
   $stdCourses ="";
                                                 $matr =$_SESSION['userID'];
                                                 $stdEmai = $_SESSION['stdEmail'];
                                                 if(!empty($stdEmai)){
                                                 //mysql_real_escape_string($con,$matr);
                                                 /*mysql_escape_mimic($matricID);
                                                 mysql_fix_string($matricID);
                                                 mysql_entities_fix_string();
                                                 sanitizeMySQL($matricID);*/
       $query = "SELECT MatricNumber,CourseUnits,CourseCode,CourseName,Semester,RegisteredAs, Department FROM studentCourseReg WHERE studentEmail ='$stdM' ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stdCourses .= "<tr><td>" .$stdList ['MatricNumber'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>". "<td>".  $stdList['CourseName'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Semester'] . "</td>" .
          "<td>" . $stdList ['RegisteredAs'] . "</td>". "</tr>";
    } }  
    
    return $stdCourses;
}

function getImage($con,$std){
    $stdmail = $std;
    $stdImg =mysqli_query($con,"Select StdPassport From students Where studentEmail ='$stdmail'");
    while ($stdImg =mysqli_fetch_array($stdImg)){
    $stdimg = $stdImg ['StdPassport'];
    }
    return $stdimg;
}


function getAllStd($con){
    $stds="";
     $query = "SELECT matricNumber,firstName,lastName,stdPhoneNumber ,department, Gender,studentLevel  FROM students ORDER BY matricNumber";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stds.=  "<tr><td>" .$stdList ['matricNumber'] . "</td>" .
        "<td>" . $stdList['firstName'] .  ' ' . $stdList['firstName'] ."</td>". "<td>".  $stdList['stdPhoneNumber '] . "</td>" .
         "<td>" . $stdList ['department'] . "</td>" .
         "<td>" . $stdList ['Gender'] . "</td>" .
         "<td>" . $stdList ['studentLevel'] . "</td>" ."</tr>";
    }
    return $stds;
}

function confirmUserAdm($con, $userID){
    $adminUser =$userID;
     $userAdm = mysqli_query($con,"Select userName UserAdmins WHERE userName ='$adminUser'");
     if($userAdm){
         while ($adm =mysqli_fetch_array($userAdm)){
             $admi = $adm['userName'];
         }
     }
     return $admi;
}

//
function getAllpayments($con){
    $stds="";
     $query = "SELECT *  FROM studentPayments ORDER BY DatePaid";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stds.="<tr><td><a href='getAllPayments.php?pId='".$stdList['PayID'].">" .$stdList ['matricID'] . "</a></td>" .
        "<td>" . $stdList['PayType'] ."</td>" ."<td>" . $stdList['AmountPaid'] ."</td>". "<td>".  $stdList['RefNumber'] . "</td>" .
         "<td>" . $stdList ['CourseCode'] . "</td>" .
         "<td>" . $stdList ['studentEmail'] . "</td>" .
         "<td>" . $stdList ['DatePaid'] . "</td>" ."</tr></a>";
    }
    return $stds;
}

function getAllCourses($con){
   $stdEmai ="";
   $stdCourses ="";
   
       $query = "SELECT * FROM Courses  ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stdCourses .= "<tr><td>" .$stdList ['CourseID'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>".
        "<td>".  $stdList['CourseTitle'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['Faculty'] . "</td>" .
        "</tr>";
    }   
    
    return $stdCourses;
}


function confirmRefNum($con) {
    $user = $_SESSION['user'];
if($app_exist=mysqli_query($con,"SELECT RefNum FROM onlineApplications WHERE Username ='$user'")){
    if(mysqli_num_rows($app_exists) >=1)
   return header('location:UserdashBoard.php?msg=You have Generated Application Form Already, You May Print Your Applicatyion PhotoCard or  Contact Admin for Assistance');
}
}

?>