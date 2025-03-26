<?php 

    session_start();
    if(isset($_SESSION['position']))
    {
        if($_SESSION['position'] != "admin")
        {
            header('Location: user.php');
        }
        
        
        
        
    }
    else header('Location: login.php');

?>