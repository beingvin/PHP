<?php include('partials/menu.php') ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Admin</h1><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Displaying Session Message
            unset($_SESSION['add']); // removing Session Message
        } elseif (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //Displaying Session Message
            unset($_SESSION['delete']); // removing Session Message
        } elseif (isset($_SESSION['update'])) {

            echo $_SESSION['update']; //Displaying Session Message
            unset($_SESSION['update']); // removing Session Message

        }
        elseif (isset($_SESSION['user-not-found'])) {

            echo $_SESSION['user-not-found']; //Displaying Session Message
            unset($_SESSION['user-not-found']); // removing Session Message

        }
        elseif (isset($_SESSION['pwd-not-match'])) {

            echo $_SESSION['pwd-not-match']; //Displaying Session Message
            unset($_SESSION['pwd-not-match']); // removing Session Message

        }
        elseif (isset($_SESSION['pwd-changed'])) {

            echo $_SESSION['pwd-changed']; //Displaying Session Message
            unset($_SESSION['pwd-changed']); // removing Session Message

        }
        elseif (isset($_SESSION['login'])) {

            echo $_SESSION['login']; //Displaying Session Message
            unset($_SESSION['login']); // removing Session Message

        }
        elseif (isset($_SESSION['user-active'])) {
            echo $_SESSION['user-active']; //Displaying Session Message
            unset($_SESSION['user-active']); // removing Session Message
        }




        ?>

        <br><br>

        <!-- button to add admin -->
        <a href="add-admin.php" class="primary-btn">Add Admin</a><br><br>


        <!-- manage users table -->

        <table class="tbl-full">
            <tr>
                <th>Sl.No</th>
                <th class="suc">Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the query     
            $res = mysqli_query($conn, $sql);

            //Check whether query is executed or no 
            if ($res == TRUE) {
                //Count rows to check if we have data in database or not 
                $count = mysqli_num_rows($res); //Function to get all the rows in database 
                $sn = 1; // Create a veriable and assign the value 

                //Check the no of rows 
                if ($count > 0) {
                    //We have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //Using while loop to get all the data from database
                        //While loop will run as long as we have data in database

                        //Get indevidual data 
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the values in our table 

            ?>
                        <tr>
                            <td> <?php echo $sn++; ?> </td>
                            <td> <?php echo $full_name; ?> </td>
                            <td> <?php echo $username; ?> </td>
                            <td>
                                
                                <a href="<?php echo SITE_URL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="primary-btn">Change Password</a>
                                <a href="<?php echo SITE_URL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="secondary-btn">Update Admin</a>
                                <a href="<?php echo SITE_URL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="denger-btn">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>



        </table>

    </div>

</div>

<!-- Main content section ends  -->




<?php include('partials/footer.php') ?>