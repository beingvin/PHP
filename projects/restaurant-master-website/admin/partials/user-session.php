<?php

    //Authorization access control
    if(!isset($_SESSION['user'])){

        //check if user session is not active 
        $_SESSION['deny-access'] = "<div class='error'> Please login to access the Admin Panel</div>";  
        //Redirect Page to login page
        header("location:" . SITE_URL . 'admin/login.php');
    }

?>