<?php
    include('../config/constants.php');

    //1.Destroy the session

    session_destroy();

    //2.redirect to login page

    //Create a Session Variable to Display Message
    $_SESSION['logout'] = "<div class='success'> Logged out successfully </div>";
                
    //Redirect Page to Manage Admin with error
    header("location:" . SITE_URL . 'admin/login.php');

?>