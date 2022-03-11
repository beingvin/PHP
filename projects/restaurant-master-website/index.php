<?php

include("partials-front/header.php");
include("config/constants.php");
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">

    <?php

    // Display session masseges 
    if (isset($_SESSION['order'])) {

        echo $_SESSION['order']; //Displaying Session Message
        unset($_SESSION['order']); // removing Session Message
    }

    ?>

    <div class="container">
        <form action="<?php echo SITE_URL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>

</section>

<!-- fOOD sEARCH Section Ends Here -->



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">

        <h2 class="text-center">Explore Foods</h2>

        <?php

        // Write query to get categories data
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

        //Execute query
        $res = mysqli_query($conn, $sql);

        //Count rows to check if we have data in database or not 
        $count = mysqli_num_rows($res); //Function to get all the rows in database 


        //Check the no of rows 
        if ($count > 0) {

            //Using while loop to get all the data from database
            while ($rows = mysqli_fetch_assoc($res)) {

                //Get indevidual data 
                $id = $rows['id'];
                $title = $rows['title'];
                $image_name = $rows['image_name'];

        ?>
        <a href="category-foods.php?id=<?php echo $id; ?>">
            <div class="box-3 float-container">

                <?php
                        //Display uploaded image
                        if ($image_name == "") {
                            //If image not available display image not availabl.
                            // echo "<div style='color:red'> Image not available. </div>";
                        ?>
                <img src=" <?php echo SITE_URL; ?>images/no-img.png" alt="Image not available"
                    class="img-responsive img-curve">

                <?php
                            //Display available image
                        } else {

                        ?>
                <img src=" <?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?> "
                    class="img-responsive img-curve" alt="<?php echo $title; ?>">
                <?php
                        }
                        ?>
                <h3 class="float-text text-white"> <?php echo $title; ?> </h3>
            </div>
        </a>
        <?php
            }
        } else {

            echo "<div style='color:red'> No category available. </div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

<!-- Categories Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        // Write query to get Food data
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes'  LIMIT 4 ";

        //Execute query
        $res2 = mysqli_query($conn, $sql2);

        //Count no of rows
        $count = mysqli_num_rows($res2);

        if ($count > 0) {

            //Using while loop get all food rows and display
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>

        <div class="food-menu-box">
            <div class="food-menu-img">

                <?php

                        //Display uploaded image
                        if ($image_name == "") {
                            //If image not available display image not available
                        ?>
                <img src=" <?php echo SITE_URL; ?>images/no-img.png" alt="Image not available"
                    class="img-responsive img-curve">

                <?php
                        } else {
                            //Display available image
                        ?>
                <img src=" <?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                    class="img-responsive img-curve">

                <?php
                        }
                        ?>
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price"> $<?php echo $price; ?></p>
                <p class="food-detail">
                    <?php echo $description; ?>
                </p>
                <br>
                <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
            </div>
        </div>
        <?php
            }
        } else {
            echo 'No food Available';
        }
        ?>

        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>

</section>
<!-- fOOD Menu Section Ends Here -->


<!-- footer starts Here -->
<?php

include("partials-front/footer.php");

?>
<!-- footer ends Here -->