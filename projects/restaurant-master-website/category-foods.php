<?php

include("partials-front/header.php");
include("config/constants.php");

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        if (isset($_GET['id'])) {

            //Get form data
            $category_id = $_GET['id'];

            // echo $category_id;

            //Write sql query and execute
            $sql = "SELECT * FROM tbl_food WHERE category_id = $category_id";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //Count rows to check if we have data in database or not 
            $count = mysqli_num_rows($res);

            if ($count > 0) {

                //Using while loop to get all the data from database
                while ($row = mysqli_fetch_assoc($res)) {

                    //Get indevidual data 
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
                echo 'No food found';
            }
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->



<!-- footer starts Here -->
<?php

include("partials-front/footer.php");

?>
<!-- footer ends Here -->