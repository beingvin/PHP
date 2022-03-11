<?php

include("partials-front/header.php");
include("config/constants.php");


?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <?php

        //Get form data
        if (isset($_POST['search'])) {

            //Create search variable and prevent sql injection 
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>
        <h2>Foods on Your Search <a href="index.php" class="text-white">"<?php echo $search; ?>"</a></h2>
        <?php
        } else {
            //If result not found display message 
            echo " <div class='error'> No search result found </div>";

            //Redirect page
            header("location:" . SITE_URL . 'index.php');
        }

        ?>



    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php

        //Write sql query and execute
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' ";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {

            while ($row = mysqli_fetch_assoc($res)) {
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

            echo '<div style="text-align:center;font-size: large;">
            <img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/000000/external-fasting-meal-dieting-flaticons-lineal-color-flat-icons.png"  />
            <br> 
            <div>No food found</div> </div>';
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