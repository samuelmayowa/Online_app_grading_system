<?php 
include_once('functions.php');
require_once('connection.php');

if(isset($_POST['login'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    
    $username = $screenData['username'];
    $password = $screenData['password'];
    
	$query =mysqli_query($con, "SELECT Username From userAccounts Where Username ='$username' AND Password ='$password'");
	if(!$query){
	echo "Username and Password is Incorrect";
	}else{
		header('location:UserdashBoard.php?user='.$username);
	}
	}
?>