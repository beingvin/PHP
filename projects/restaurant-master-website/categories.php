<?php

include("partials-front/header.php");
include("config/constants.php");

?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php

        // Write query to get categories data
        $sql = "SELECT * FROM tbl_category ";

        //Exicute query
        $res = mysqli_query($conn, $sql);

        //Count rows to check if we have data in database or not 
        $count = mysqli_num_rows($res);

        if ($count > 0) {

            //Using while loop to get all the data from database
            while ($row = mysqli_fetch_assoc($res)) {

                //Get indevidual data 
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

        ?>
        <a href="category-foods.php?id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"
                    class="img-responsive img-curve">

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
        </a>
        <?php

            }
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- Categories Section Ends Here -->

<?php

include("partials-front/footer.php");

?>