<?php include('partials/menu.php') ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Category</h1><br>

        <?php
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category']; //Displaying Session Message
            unset($_SESSION['add-category']); // removing Session Message
        } elseif (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //Displaying Session Message
            unset($_SESSION['delete']); // removing Session Message
        }elseif (isset($_SESSION['update'])) {

            echo $_SESSION['update']; //Displaying Session Message
            unset($_SESSION['update']); // removing Session Message

        }

        ?>

        <br><br>

        <!-- button to add admin -->
        <a href="add-category.php" class="primary-btn">Add Category</a><br><br>


        <!-- manage users table -->

        <table class="tbl-full">
            <tr>
                <th>Sl.No</th>
                <th class="suc">Title</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to get all admin
            $sql = "SELECT * FROM tbl_category";
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
                    while ($row = mysqli_fetch_assoc($res)) {
                        //Using while loop to get all the data from database
                        //While loop will run as long as we have data in database

                        //Get indevidual data 
                        $id = $row['id'];
                        $title = $row['title'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        //Display the values in our table 

            ?>
                        <tr>
                            <td> <?php echo $sn++; ?> </td>
                            <td> <?php echo $title; ?> </td>
                            <td> <?php echo $featured; ?> </td>
                            <td> <?php echo $active; ?> </td>

                            <td>
                                
                                
                                <a href="<?php echo SITE_URL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="secondary-btn">Update category</a>
                                <a href="<?php echo SITE_URL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="denger-btn">Delete category</a>
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