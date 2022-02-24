<?php 
    session_start();
    //Create Constant to store Non Repeating Values

    define('SITE_URL', 'http://localhost/projects/web-design-course-restaurant-master/');
    define('LOCAL_HOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD', '');
    define('DB_NAME','food_order_site');


    $conn = mysqli_connect(LOCAL_HOST, DB_USERNAME, DB_PASSWORD ) or die( mysqli_error()); //Database Connection   
    $db_select = mysqli_select_db($conn, DB_NAME) or die( mysqli_error()); //Selecting Database
?>