<?php 
include_once('functions.php');
require_once('connection.php');
$regnum="";
if(isset($_GET['regnum'])){
    $regnum=$_GET['regnum'];
}else{
    header("loaction: sign_in.php");
}

  	$query = mysqli_query($con, "SELECT * From jamb_data Where RG_NUM ='$regnum'");
	if($query){
	    $usr =mysqli_num_rows($query) ;
	  if(!empty($usr)){
	      while($user=mysqli_fetch_array($query)){
	          $id=$user['id'];
	          $regno=$user['RG_NUM'];
	          $name = $user['RG_CANDNAME'];
	          $sex = $user['RG_SEX'];
	          $state = $user['STATE_NAME'];
	          $score = $user['RG_AGGREGATE'];
	          $lga = $user['LGA_NAME'];
	          $phone = $user['PHONE NUMBER'];
	      }
	      $userdata = ([
	          'regno' => $regno,
	          'name' => $name,
	          'sex' => $sex,
	          'state' => $state,
	          'score' => $score,
	          'lga' => $lga,
	          'phone' => $phone
	      ]);
	      $data = ([
    	    'error' => false,
    	    'message' => 'User Available',
    	    'userdata' => $userdata
    	    ]);
	  
	      setcookie('regnum', $regnum, time()+3600,'/');
	      
	  }else{
	      $data = ([
	    'error' => false,
	    'message' => 'Error: User does not exist',
	    'userdata' => 'no data'
	    ]);
	  }
	   echo json_encode($data);
	}
	