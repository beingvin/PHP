<?php include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Change Password</h1> <br>

        <br>

        <?php

        $id = $_GET['id'];

        echo $id;

        //2.Create query to delete admin 

        // $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // //3.Execute the query

        // $res = mysqli_query($conn, $sql);

        // //4.Check wether the data is inserted or not and disply appropriate message
        // if ($res == TRUE) {

        //     //Check the data available or not
        //     $count = mysqli_num_rows($res);

        //     if ($count == 1) {
        //         // echo "admin available";

        //         $row = mysqli_fetch_assoc($res);

        //         $full_name = $row['full_name'];
        //         $username = $row['username'];
        //     }
        // }

        ?>

        <!-- manage oders table -->
        <form action="" method="POST">

            <table class="tbl-50">



                <tr>
                    <td>Current Passowrd :</td>
                    <td> <input class="input" type="password" name="current_password" placeholder="current Password"> </td>

                </tr>

                <tr>
                    <td>New Password :</td>
                    <td> <input class="input" type="password" name="new_password" placeholder="New Password"> </td>

                </tr>

                <tr>
                    <td>Confirm Password :</td>
                    <td> <input class="input" type="password" name="confirm_password" placeholder="Confirm Password"> </td>

                </tr>

                <tr>

                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" class="submit-btn">

                        <input type="submit" name="submit" value="Change Password" class="submit-btn">
                    </td>

                </tr>

            </table>

        </form>


    </div>

</div>

<!-- Main content section ends  -->


<?php include('partials/footer.php'); ?>


<?php

if (isset($_POST['submit'])) {

    //Get all the values from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);   
    $confirm_password = md5($_POST['confirm_password']);
   
    //Create a sql query to check if current ID and password is exists or nor
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password ='$current_password'";



    // Execute the query 
    $res = mysqli_query($conn, $sql);



    if ($res == TRUE) {

        //Check whether user is available ot not 
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // echo 'User Found';

            //Verify new password and confirm password 
            if ($new_password == $confirm_password) {

                // Create query to Update new password
                $sql2 = "UPDATE tbl_admin SET 
                        password='$new_password'
                        WHERE id = $id
                ";

                // Execute query
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == TRUE) {

                    //Create a Session Variable to Display Message
                    $_SESSION['pwd-changed'] = "<div class='success'> Password changed successfully </div>";
                    
                    //Redirect Page to Manage Admin with error
                    header("location:" . SITE_URL . 'admin/manage-admin.php');

                } else {

                    //Create a Session Variable to Display Message
                    $_SESSION['pwd-changed'] = "<div class='error'> Password change failed , Try again.</div>";
                    
                    //Redirect Page to Manage Admin with error
                    header("location:" . SITE_URL . 'admin/manage-admin.php');

                }
            } else {

                $_SESSION['pwd-not-match'] = "<div class='error'> Password did not match </div>";
                //Redirect Page to Manage Admin with error
                header("location:" . SITE_URL . 'admin/manage-admin.php');
            }
        } else {
            // echo 'User not Found ';

            //Create a Session Variable to Display Message
            $_SESSION['user-not-found'] = "<div class='error'> User not found or Password incorrect </div>";
            //Redirect Page to Manage Admin with error
            header("location:" . SITE_URL . 'admin/manage-admin.php');
        }
    } else {
        echo "Something went wrong";
    }

}


?>