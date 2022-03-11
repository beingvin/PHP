<?php include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Add Admin</h1> <br>

        <?php

        ?>

        <br>

        <!-- Add Admin form -->

        <form action="" method="POST">

            <table class="tbl-50">

                <tr>
                    <td>Full Name :</td>
                    <td> <input class="input" type="text" name="Full_Name" placeholder="Enter your name"> </td>

                </tr>

                <tr>
                    <td>Username :</td>
                    <td> <input class="input" type="text" name="Username" placeholder="Enter your Username"> </td>

                </tr>

                <tr>
                    <td>Password :</td>
                    <td> <input class="input" type="password" name="Password" placeholder="Enter your Password"> </td>

                </tr>

                <tr>

                    <td colspan='2'>
                        <input type="submit" name="submit" value="Add-Admin" class="submit-btn">
                    </td>

                </tr>

            </table>

        </form>

    </div>

</div>

<!-- Main content section ends  -->

<!-- Footer section starts  -->

<?php include('partials/footer.php'); ?>

<!-- Footer section ends  -->


<?php

//Process the value from form and save it in to Databse

// Check wether submit button is clicked or not
if (isset($_POST['submit'])) {

    // echo 'Button clicked';

    //1.Get the data from the form 
    $full_name = $_POST['Full_Name'];
    $username = $_POST['Username'];
    $password = md5($_POST['Password']);

    //2.SQL query to save data into Database
    $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
            ";

    //3.Execute Query and save Data into Databse
    $res = mysqli_query($conn, $sql);

    //4.Check wether the data is inserted or not and disply appropriate message
    if ($res == TRUE) {

        // echo 'Data inserted';

        //Create a Session Variable to Display Message
        $_SESSION['add-admin'] = "<div class='success'> Admin Added Successfully </div>";

        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/manage-admin.php');
    } else {

        // echo 'Data not inserted';

        //Create a Session Variable to Display Message
        $_SESSION['add-admin'] = "<div class='error'> Failed to add admin </div>";

        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/manage-admin.php');
    }
}

?>