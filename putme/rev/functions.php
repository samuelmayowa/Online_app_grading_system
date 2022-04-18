<?php
require('connection.php');
session_start();
$resp="";
$courseCode="";

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
/*function getStaff($userID, $passkey){
    $query = "Select userName, password FROM UserAdmins WHERE userName='$userID' AND password = '$passkey'";
    $query=mysqli_query($con,$query);
    if(!$query){
      return  mysqli_error($con);
    }
    else{
        if(mysql_num_rows($query) != 1){
            return mysqli_error($con);
        }else{
            
            return  header("location:dashboard.php?msg=Welcome, ".$userID. '!');
        }
    }
}
*/

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