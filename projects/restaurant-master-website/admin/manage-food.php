<?php include('partials/menu.php') ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Food</h1><br>

        <!-- Display session masseges Start-->

        <?php

        if (isset($_SESSION['update-order'])) {

            echo $_SESSION['update-order']; //Displaying Session Message
            unset($_SESSION['update-order']); // removing Session Message

        } elseif (isset($_SESSION['delete-food'])) {

            echo $_SESSION['delete-food']; //Displaying Session Message
            unset($_SESSION['delete-food']); // removing Session Message

        } elseif (isset($_SESSION['food-update'])) {

            echo $_SESSION['food-update']; //Displaying Session Message
            unset($_SESSION['food-update']); // removing Session Message

        } elseif (isset($_SESSION['food-not-found'])) {

            echo $_SESSION['food-not-found']; //Displaying Session Message
            unset($_SESSION['food-not-found']); // removing Session Message

        } elseif (isset($_SESSION['upload'])) {

            echo $_SESSION['upload-failed']; //Displaying Session Message
            unset($_SESSION['upload-failed']); // removing Session Message

        } elseif (isset($_SESSION['remove-image'])) {

            echo $_SESSION['remove-image']; //Displaying Session Message
            unset($_SESSION['remove-image']); // removing Session Message
        }

        ?>

        <!-- Display session masseges Ends-->

        <br><br>

        <!-- button to add category -->
        <a href="add-food.php" class="primary-btn">Add Food</a><br><br>

        <!-- manage food table -->

        <table class="tbl-full">
            <tr>
                <th>Sl.No</th>
                <th class="suc">Title</th>
                <!-- <th>Description</th> -->
                <th>Price</th>
                <th>Image Name</th>
                <!-- <th>Category_id</th> -->
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            //1.sql query to get all food
            $sql = "SELECT * FROM tbl_food";

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
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $category_id = $row['category_id'];
                        $featured = $row['featured'];
                        $active = $row['active'];

            ?>
            <!-- Display the values in our table  -->
            <tr>
                <td> <?php echo $sn++; ?> </td>
                <td> <?php echo $title; ?> </td>
                <!-- <td> <?php echo $description; ?> </td> -->
                <td> $ <?php echo $price; ?> </td>

                <td>

                    <?php
                                //Display uploaded image
                                if ($image_name != "") {
                                ?>
                    <img src="  <?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?> " width='80px'
                        height="50px">

                    <?php

                                    //If image not available display image not available
                                } else {
                                    echo "<div style='color:red'>  Image not available. </div>";
                                }

                                ?>

                </td>
                <!-- <td> <?php echo $category_id; ?> </td> -->
                <td> <?php echo $featured; ?> </td>
                <td> <?php echo $active; ?> </td>

                <td>
                    <a href="<?php echo SITE_URL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                        class="secondary-btn">Update category</a>
                    <a href="<?php echo SITE_URL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
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