<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>


<div class="login">

    <h1>Admin Login</h1>

    <?php
    include('../config/constants.php');

    if (isset($_SESSION['logout'])) {
        echo '<br>';
        echo $_SESSION['logout']; //Displaying Session Message
        unset($_SESSION['logout']); // removing Session Message
        
    }
    elseif (isset($_SESSION['login'])) {
        echo '<br>';
        echo $_SESSION['login']; //Displaying Session Message
        
        unset($_SESSION['login']); // removing Session Message
       
    }
    ?>

    

    <form action="" method="POST">

<table class="tbl-50">


    <br>

    <tr>
        <td>Username :</td>
        <td> <input class="input" type="text" name="username" placeholder="Enter username"> </td>

    </tr>


    <tr>
        <td>Password :</td>
        <td> <input class="input" type="password" name="password" placeholder="Enter Password"> </td>

    </tr>

    <tr>

        <td colspan='2'>
            

            <input type="submit" name="submit" value="Login" class="submit-btn">
        </td>

    </tr>

</table>

</form>

</div>

<?php 

    //check if user session is active 
    if (isset($_SESSION['user'])){

        // If user session active Create a Session Variable to Display Message
        $_SESSION['user-active'] = "<div class='error'> User already logged in.</div>";
         //Redirect Page to Manage Admin with error
         header("location:" . SITE_URL . 'admin/manage-admin.php');
    }
    else {
        //Check if submit button clicked or not 
        if(isset($_POST['submit'])){

            echo 'button clicked ';
            echo "<br>";    
            //1.Get form values
            $username = $_POST['username'];
            $password = md5($_POST['password']);


            //2.SQL query to check if username and password are in database.
            $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

            //3.Execute the query
            $res = mysqli_query($conn, $sql);

            //4.Check if User Avalable or no
            if ($res == TRUE){
                
                $count = mysqli_num_rows($res);

                if ($count==1){

                        //If login successful Create a Session Variable to Display Message
                        $_SESSION['login'] = "<div class='success'> Logged in successfully </div>";
                            //Check session if user is already logged in and unset logout
                            $_SESSION['user']= $username;

                        //Redirect Page to Manage Admin with error
                        header("location:" . SITE_URL . 'admin/manage-admin.php');
                }
                else {

                    //If User athentication fail, Create a Session Variable to Display Message
                    $_SESSION['login'] = "<div class='error'> Incorrect Credentials  , Try again.</div>";
                        
                    //Redirect Page to Manage Admin with error
                    header("location:" . SITE_URL . 'admin/login.php');
                }
            }


        }

        
    }
?>
    


</body>
</html>