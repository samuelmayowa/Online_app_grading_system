<?php 
include_once('functions.php');
require_once('connection.php');

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
        echo "<script> alert('Your Password Does Not match');<script>";
        //header('location:createAccount.php');
    } else {
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
                                   header('location:login.php?id='.$username. '&& msg=User Created Succefully, Login With Your Username and Password to Proceeds To Application Form');
                                }
    }
}
//echo $msg; 
?>
