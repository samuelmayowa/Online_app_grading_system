<?php 
session_start();
function killSessionData($sessionValue){
    
    if(isset($_SESSION)){
        
    $_SESSION = array();
    if(session_id() != '' || isset($_COOKIE[session_name($_SESSION['userID'])])){
        setcookie(session_name(),'', time() - 36000, '/');
    session_destroy();
        header('location:login.php?msg=You are Now Logged Out');
    
}
    }

}


killSessionData ($_SESSION['userID']);

?>