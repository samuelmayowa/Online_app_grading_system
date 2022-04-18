<?php
   require ('../functions.php');
 require ('../connection.php');
 
if(isset($_POST['PayType'])){
$payID = $_POST['PayType'];

	$query =mysqli_query($con, "Select ID, Amount from paymentCategories WHERE payCategories ='$payID'");
	while($row=mysqli_fetch_array($query)){
	$payID = $row['ID'];
	$amt =$row['Amount'];
	echo "<option value='". $amt. "'> $amt </option>";
	}


	}
	
	
	
?>