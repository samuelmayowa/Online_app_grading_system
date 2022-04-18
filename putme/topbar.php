<?php 
$id=$_SESSION['userID'];
//echo "<script> alert('$id'); </script>"; 

 $file_path=$_SESSION['file_path'];
 
// echo "<script> alert('$sn'); </script>"; 
 
 $name='';
 if($id){
    $user_data = mysqli_query($con, "SELECT * FROM onlineApplications Where Username ='$id'");
    $fetch_user_data = mysqli_fetch_assoc($user_data);
    //$name = $fetch_user_data['Surname'].' '.$fetch_user_data['FirstName'];
    $phone = $fetch_user_data['PhoneNumber'];
    $email = $fetch_user_data['Email'];
    $designation = $fetch_user_data['Designation'];
    $pix=$fetch_user_data['passport'];
    $sn=$fetch_user_data['Surname'];
    $mn=$fetch_user_data['MiddleName'];
    $fn=$fetch_user_data['FirstName'];
    $name= $fn .'  '. $mn . '  ' .$sn;
    $pix=$fetch_user_data['passport'];
    $gender=$fetch_user_data['Gender'];
   }
$dfaulti_img="https://i.pinimg.com/originals/43/96/61/439661dcc0d410d476d6d421b1812540.jpg";
echo "<script> alert('Welcome ! ' + '$name'); </script>"; 
 ?>

<style>
     /*.image_inner_container{*/
     /*  	border-radius: 50%;*/
     /*  	padding: 5px;*/
     /*   background: #833ab4; */
     /*   background: -webkit-linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4); */
     /*   background: linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4);*/
     /*  }*/
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
       input{
           color:black;
       }
 </style>
 <nav class="sb-topnav navbar navbar-expand navbar-gray bg-green" style="background-color:teal; color:#fff;">
            <a class="navbar-brand" href="UserdashBoard.php?msg=<?php echo $_SESSION['userID']; ?>" style="color:#fff;"><?php if(isset($name)){ echo $name;  }else { echo 'ESCOHST-IJERO'; }  ?></a>
                                 <a class="nav-link" href="profiles.php?msg=<?php echo $_SESSION['userID']; ?>">
                                     <div class="image_inner_container">
					                   &nbsp; &nbsp;  <img src="<?php if(isset($file_path)) { echo $file_path; } else { echo $dfaulti_img; } ?>">
				                    </div>
				                </a>
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
                        <a class="dropdown-item" href="UserdashBoard.php?user=<?php echo $id; ?>">Home</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="UserdashBoard.php?user=<?php echo $id; ?>">My Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="photoCard.php?user=<?php echo $id; ?>">PhotoCard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>