<?php include('partials/menu.php') ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Category</h1><br>

        <!-- Display session masseges Start-->

        <?php
        if (isset($_SESSION['add-category'])) {

            echo $_SESSION['add-category']; //Displaying Session Message
            unset($_SESSION['add-category']); // removing Session Message

        } elseif (isset($_SESSION['delete-category'])) {

            echo $_SESSION['delete-category']; //Displaying Session Message
            unset($_SESSION['delete-category']); // removing Session Message

        } elseif (isset($_SESSION['update-category'])) {

            echo $_SESSION['update-category']; //Displaying Session Message
            unset($_SESSION['update-categorye']); // removing Session Message

        } elseif (isset($_SESSION['category-not-found'])) {

            echo $_SESSION['category-not-found']; //Displaying Session Message
            unset($_SESSION['category-not-found']); // removing Session Message

        } elseif (isset($_SESSION['upload-image'])) {

            echo $_SESSION['upload-image']; //Displaying Session Message
            unset($_SESSION['upload-image']); // removing Session Message

        } elseif (isset($_SESSION['remove-image'])) {

            echo $_SESSION['remove-image']; //Displaying Session Message
            unset($_SESSION['remove-image']); // removing Session Message

        }

        ?>

        <!-- Display session masseges Ends-->

        <br><br>

        <!-- button to add category -->
        <a href="add-category.php" class="primary-btn">Add Category</a><br><br>


        <!-- manage category table -->

        <table class="tbl-full">
            <tr>
                <th>Sl.No</th>
                <th class="suc">Title</th>
                <th>Image Name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            //1.sql query to get all category
            $sql = "SELECT * FROM tbl_category";

            //2.Execute the query     
            $res = mysqli_query($conn, $sql);

            //3.Check whether query is executed or no 
            if ($res == TRUE) {

                //Count rows to check if we have data in database or not 
                $count = mysqli_num_rows($res); //Function to get all the rows in database 
                $sn = 1; // Create a veriable and assign the value 

                //Check the no of rows 
                if ($count > 0) {

                    //We have data in database
                    //Using while loop to get all the data from database
                    //While loop will run as long as we have data in database
                    while ($row = mysqli_fetch_assoc($res)) {

                        //Get indevidual data 
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

            ?>
            <!-- Display the values in our table  -->
            <tr>
                <td> <?php echo $sn++; ?> </td>
                <td> <?php echo $title; ?> </td>
                <td>

                    <?php
                                //Display uploaded image
                                if ($image_name != "") {
                                ?>
                    <img src="  <?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?> " width='80px'
                        height="50px">

                    <?php

                                    //If image not available display image not available
                                } else {
                                    echo "<div style='color:red'>  Image not available. </div>";
                                }

                                ?>

                </td>
                <td> <?php echo $featured; ?> </td>
                <td> <?php echo $active; ?> </td>

                <td>


                    <a href="<?php echo SITE_URL; ?>admin/update-category.php?id=<?php echo $id; ?>"
                        class="secondary-btn">Update category</a>
                    <a href="<?php echo SITE_URL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="denger-btn">Delete category</a>
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



<!-- Footer section starts  -->

<?php include('partials/footer.php') ?>

<!-- Footer section ends  -->