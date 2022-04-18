<?php

 require ('connection.php');
if(isset($_POST['FacID'])){
$CourseID = $_POST['FacID'];

	$query =mysqli_query($con, "Select ID, DeptName from Departments WHERE FacID =".$CourseID);
	while($row=mysqli_fetch_array($query)){
	$CourseID = $row['ID'];
	$CourseName =$row['DeptName'];
	echo "<option value='". $CourseName. "'> $CourseName </option>";

		}
	}
	
		
	if(isset($_POST['CourseTitleID'])){
$TitleID = $_POST['CourseTitleID'];

	$query =mysqli_query($con, "Select * from CourseUnits WHERE CourseTitleID =".$TitleID);
	while($row=mysqli_fetch_array($query)){
	$CourseTitleID = $row['CourseTitleID'];
	$CourseUnits =$row['CourseUnits'];
	echo "<option value='". $CourseUnits. "'> $CourseUnits </option>";

		}


	}
?>