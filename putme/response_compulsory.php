<?php 
include_once('functions.php');
require_once('connection.php');
$std_reg = user_data($_SESSION['user'], $con);
$score = user_score($std_reg, $con)['score'];
if(!$score){
    header('location:UserdashBoard.php?msg=Only Admitted students can access compulsory fees page!');
}

//SHA512 (rrr/orderId+api_key+merchantId)
if(isset($_GET['RRR']) && isset($_GET['orderID'])){
    
    $rrrget = $_GET['RRR'];
    $orderIDget = $_GET['orderID'];
    $username= $_SESSION['user'];
    
    
}elseif(isset($_GET['RRR']) && isset($_GET['status']) && isset($_GET['statuscode'])){
    $rrrget = $_GET['RRR'];
    $statusget = $_GET['status'];
    $statuscodeget = $_GET['statuscode'];
    $username= $_SESSION['user'];
    
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
                        <a class="dropdown-item" href="myProfiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Response Page</h3></div>

                                        <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php if(isset($upd)){ echo  $upd; } ?>
                                                        </h3>
                                                                        
                                                                        </div>
                                  
                                    <div class="card-body" style="text-align:center;">
                                        
                                        <p id="response"></p>
                                        
                                        

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
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti. <?php echo date('Y')?></div>
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
     <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <?php if(!empty($rrrget) && !empty($orderIDget)){ ?>
        
       <script>
        $.ajax({   
                            url:"/rrr-paymentstatus-compulsory.php?user=<?php echo $username; ?>&rrr=<?php echo $rrrget;?>&orderId=<?php echo $orderIDget; ?>",
                            type: 'POST',
                            cache:false,
                            //data: dataString,
                            beforeSend: function() {},
                            timeout:10000,
                            error: function() {
                                /*Swal.fire({
                                title: "Error!",
                                text: "Error. Refresh and try again!",
                                type: "error",
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                                });*/
                             },    
                            success: function(response) {
                                 $("#response").html(response+', Please wait...');
                               // alert("Deposit Placed");
                                /*Swal.fire({
                                title: "Success!",
                                text: "Success. "+response,
                                type: "success",
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                                });*/
                                
                                
                            setTimeout(function() { 
                             window.location.href = "/print_success_comp.php";
                            }, 10000);
                            } 
                        });
                        
       </script>
       
       <?php } elseif(!empty($rrrget) && !empty($statusget) && !empty($statuscodeget)){ ?>
       <script>
        $.ajax({   
                   url:"/rrr-paymentstatus-compulsory.php?user=<?php echo $username; ?>&rrr=<?php echo $rrrget; ?>&statusGet=<?php echo $statusget; ?>&statusCodeGet=<?php echo $statuscodeget; ?>",
                            type: 'POST',
                            cache:false,
                            //data: dataString,
                            beforeSend: function() {},
                            timeout:10000,
                            error: function() {
                                /*Swal.fire({
                                title: "Error!",
                                text: "Error. Refresh and try again!",
                                type: "error",
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                                });*/
                             },    
                            success: function(response) {
                                 $("#response").html(response+', Please wait...');
                               // alert("Deposit Placed");
                                /*Swal.fire({
                                title: "Success!",
                                text: "Success. "+response,
                                type: "success",
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                                });*/
                                
                            setTimeout(function() { 
                             window.location.href = "/print_success_comp.php";
                            }, 10000);
                            } 
                        });
                        
       </script>
       <?php }?>
    </body>
</html>


