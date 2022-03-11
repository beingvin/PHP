<?php include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Update Category</h1> <br>

        <br>

        <!-- Get data from the database -->

        <?php

        //1.Get the data from the form 
        if (isset($_GET['id'])) {

            //1.Get the ID of the category to be updated
            $id = $_GET['id'];

            //2.Create query to update category
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //3.Execute the query 
            $res = mysqli_query($conn, $sql);

            //4.Check wether the data is inserted or not and disply appropriate message
            if ($res == TRUE) {

                //Check the data available or not
                $count = mysqli_num_rows($res);

                if ($count == 1) {

                    $row = mysqli_fetch_assoc($res);

                    //Get indevidual data 
                    $id = $row['id'];
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {

                    //Redirect to manage category page with error message
                    $_SESSION['category-not-found'] = "<div class='error'> Category not found. </div>";
                    header("location:" . SITE_URL . 'admin/manage-category.php');
                }
            }
        } else {

            //Redirect to manage category page with error message
            $_SESSION['category-not-found'] = "<div class='error'> Category not found. </div>";
            header("location:" . SITE_URL . 'admin/manage-category.php');
        }

        ?>

        <!-- Get data from the database ends  -->


        <!-- manage oders table -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-50">


                <tr>
                    <td>Title :</td>
                    <td> <input class="input" type="text" name="title" placeholder="Category title"
                            value="<?php echo $title; ?>"> </td>

                </tr>
                <tr>
                    <td>Current Image :</td>
                    <td>
                        <?php
                        if ($current_image != "") {

                            //Display the image
                        ?>
                        <img src="<?php echo SITE_URL; ?>images/category/<?php echo $current_image; ?> "
                            alt="<?php echo $current_image; ?>" width='80px' height="50px">
                        <?php


                        } else {

                            //Display the error message
                            echo "<div style='color:red'>  Image not available. </div>";
                        }

                        ?>
                    </td>


                </tr>

                <tr>
                    <td>New Image :</td>
                    <td> <input type="file" name="image"> </td>

                </tr>

                <tr>

                    <td>Featured :</td>

                    <td>

                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                }  ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                }  ?> type="radio" name="featured" value="No"> No

                    </td>

                </tr>

                <tr>

                    <td>Active :</td>

                    <td>

                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                }  ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if ($active == "No") {
                                    echo "checked";
                                }  ?> type="radio" name="active" value="No">
                        No

                    </td>
                </tr>

                <tr>

                    <td colspan='2'>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update-Category" class="submit-btn">
                    </td>

                </tr>

            </table>

        </form>


    </div>

</div>

<!-- Main content section ends  -->


<!-- Footer section starts  -->

<?php include('partials/footer.php') ?>

<!-- Footer section ends  -->



<?php

//Process the value from form and save it in to Databse

// Check wether submit button is clicked or not
if (isset($_POST['submit'])) {

    //1.Get the data from the form 
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
    $featured = mysqli_real_escape_string($conn, $_POST['featured']);
    $active = mysqli_real_escape_string($conn, $_POST['active']);

    //Check if new image is selected 
    if (isset($_FILES['image']['name'])) {

        // Get image file name
        $image_name = $_FILES['image']['name'];

        //Check if image is available or no
        if ($image_name != "") {

            // Get image file name
            $image_name = $_FILES['image']['name'];

            //Get the extention of the image (.jpg, .gif, .pnp, etc) to autorename image file name
            $ext = end(explode('.', $image_name));

            //rename image file name 
            $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; //e.g Food_category_544.jpg

            //source path
            $source_path = $_FILES['image']['tmp_name'];

            //Set the destiation path 
            $destination_path = "../images/category/" . $image_name;
            //upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == FALSE) {
                //Create a Session Variable to Display Message
                $_SESSION['upload-image'] = "<div class='error'> Failed to Upload Image </div>";
                //Redirect Page to Manage Admin 
                header("location:" . SITE_URL . 'admin/manage-category.php');
                die(); // break the code here
            }

            if ($current_image != '') {
                //Remove the image
                $path = "../images/category/" . $current_image;
                $remove = unlink($path);
                if ($remove == false) {
                    //Set the session message
                    $_SESSION['remove-image'] = "<div class='error'>Failed to remove image.</div>";
                    //Redirect to manage category page
                    header('location:' . SITE_URL . 'admin/manage-category.php');

                    //stop the process 
                    die();
                }
            }
        } else {

            $image_name = $current_image;
        }
    } else {

        $image_name = $current_image;
    }

    // 2.Create a sql query to update category 
    $sql2 = "UPDATE tbl_category SET 
            title='$title',
            image_name ='$image_name',
            featured='$featured',
            active='$active'
            WHERE id = '$id'
            ";

    //3.Execute Query and save Data into Databse
    $res = mysqli_query($conn, $sql2);

    //4.Check wether the data is inserted or not and disply appropriate message
    if ($res == TRUE) {

        //Create a Session Variable to Display Message
        $_SESSION['update-category'] = "<div class='success'> category Updated Successfully </div>";

        //Redirect Page to Manage Category 
        header("location:" . SITE_URL . 'admin/manage-category.php');
    } else {

        //Create a Session Variable to Display Message
        $_SESSION['update-category'] = "<div class='error'> Failed to update category </div>";

        //Redirect Page to Manage Category
        header("location:" . SITE_URL . 'admin/manage-category.php');
    }
}

?>