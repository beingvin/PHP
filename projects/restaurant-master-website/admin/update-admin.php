<?php include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Update Admin</h1> <br>

        <br>

        <!-- Get data from the database -->

        <?php

        //1.Get the ID of the admin to be updated
        $id = $_GET['id'];

        //2.Create query to update admin 
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //3.Execute the query
        $res = mysqli_query($conn, $sql);

        //4.Check wether the data is inserted or not and disply appropriate message
        if ($res == TRUE) {

            //Check the data available or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {

                // echo "admin available";

                $row = mysqli_fetch_assoc($res);

                //Get indevidual data 
                $full_name = $row['full_name'];
                $username = $row['username'];
            }
        }

        ?>

        <!-- Get data from the database ends  -->


        <!-- update admin table -->
        <form action="" method="POST">

            <table class="tbl-50">

                <tr>
                    <td>Full name :</td>
                    <td> <input class="input" type="text" name="full_name" value="<?php echo $full_name; ?>"> </td>

                </tr>

                <tr>
                    <td>Username:</td>
                    <td> <input class="input" type="text" name="username" value="<?php echo $username; ?>"> </td>

                </tr>


                <td colspan='2'>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" class="submit-btn">

                    <input type="submit" name="submit" value="Update Admin" class="submit-btn">
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

    //1.Get the data from the form 
    $id = $_POST['id'];
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    //2.Create a sql query to update admin
    $sql = "UPDATE tbl_admin SET 
            full_name = '$full_name',
            username = '$username'
            WHERE id = '$id'
            ";

    //3.Execute Query and save Data into Databse
    $res = mysqli_query($conn, $sql);

    //Check wether the data is inserted or not and disply appropriate message
    if ($res == TRUE) {

        //Create a Session Variable to Display Message
        $_SESSION['update-admin,'] = "<div class='success'> Admin Updated Successfully </div>";

        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/manage-admin.php');
    } else {

        //Create a Session Variable to Display Message
        $_SESSION['update-admin'] = "<div class='error'> Failed to update Admin </div>";

        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/manage-admin.php');
    }
}


?>