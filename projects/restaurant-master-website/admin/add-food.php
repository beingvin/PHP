<?php
ob_start();
include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Add Category</h1> <br>

        <?php
        if (isset($_SESSION['add-new-food'])) {
            echo $_SESSION['add-new-food']; //Displaying Session Message
            unset($_SESSION['add-new-food']); // removing Session Message
        } 
        elseif (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>



        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-50">


                <tr>
                    <td>Title :</td>
                    <td> <input class="input" type="text" name="title" placeholder="Food title"> </td>

                </tr>

                <tr>
                    <td>Description :</td>
                    <td> <textarea class="input" name="description" cols="30" rows="8"
                            placeholder="Food discription"></textarea> </td>

                </tr>

                <tr>
                    <td>Price :</td>
                    <td> <input class="input" type="number" name="price" placeholder="Food price"> </td>

                </tr>

                <tr>
                    <td>Select Image :</td>
                    <td> <input class="input" type="file" name="image"> </td>

                </tr>

                <tr>
                    <td>Category :</td>

                    <td>
                        <select class="input" name="category" required>
                            <?php

                                //Create query to display categories from database

                                //1.Get all active categories from database 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                                //2.Execute the query
                                $res = mysqli_query($conn, $sql);

                                //3.Count rows to check if we have categories or not
                                $count = mysqli_num_rows($res);
                                
                                //If count if greater than zero , we have categories else we dont have 
                                if ($count > 0) {
                                    
                                    while ($row = mysqli_fetch_assoc($res)) {

                                        //Get the the data from the database
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        //Display categories from database on dropdown
                                        ?>
                            <option value="<?php echo $id; ?>"><?php echo $title; ?> </option>
                            <?php
                                    }
                                } else {

                                    //Display categories categories not found on dropdown
                                    ?>
                            <option value="0">No category found</option>
                            <?php

                                }


                            ?>
                        </select>
                    </td>

                </tr>

                <tr>

                    <td>Featured :</td>
                    <td> <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>

                </tr>

                <tr>
                    <td>Active :</td>
                    <td> <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>

                    <td colspan='2'>
                        <br>
                        <input type="submit" name="submit" value="Add-Food" class="submit-btn">
                    </td>

                </tr>

            </table>

        </form>

    </div>

</div>

<!-- Main content section ends  -->



<!-- footer section starts  -->

<?php include('partials/footer.php'); ?>

<!-- footer section ends  -->



<?php

        //Process the value from form and save it in to Databse
        // Check wether submit button is clicked or not
        if (isset($_POST['submit'])) {


            //1.Get the data from the form ///////////////////////////////////////////////////

            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            //Check if image is selected or no and set the value for image name

            // print_r($_FILES['image']);
            // die(); // break the code here

            if (isset($_FILES['image']['name'])) {

                // Get image file name
                $image_name = $_FILES['image']['name'];

                

                // Upload the image only if image is selected 
                if ($image_name != "") {

                    

                    //Get the extention of the image (.jpg, .gif, .pnp, etc) to autorename image file name
                    $file_name = explode('.', $image_name);
                    $ext = end($file_name);

                    

                    //rename image file name 
                    $image_name = "Food_Name_" . rand(000, 999) . '.' . $ext; //e.g Food_category_544.jpg

                    //source path
                    $source_path = $_FILES['image']['tmp_name'];

                    //Set the destiation path 
                    $destination_path = "../images/food/" . $image_name;

                    //upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check if images is uloaded or no
                    if ($upload == FALSE) {

                        //Create a Session Variable to Display Message
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload Image </div>";

                        //Redirect Page to Manage Admin 
                        header("location:" . SITE_URL . 'admin/add-food.php');
                        ob_end_flush();
                        die(); // break the code here
                    }
                }

            } else {
                //if image not upoaded set image name as blank
                $image_name = '';
            }


            $category_id = $_POST['category'];

            //Check if featured redio button is selected ot not 
            if (isset($_POST['featured'])) {

                //Get the value from form
                $featured = $_POST['featured'];
            } else {

                //Set defualt value as "No"
                $featured = 'No';
            }

            //Check if active redio button is selected ot not 
            if (isset($_POST['active'])) {

                //Get the value from form
                $active = $_POST['active'];
            } else {

                //Set defualt value as "No"
                $active  = 'No';
            }

            
            // 2.SQL query to save data into Database ///////////////////////////////////////////////////

            $sql2 = "INSERT INTO tbl_food SET 
            title='$title',
            description = '$description',
            price = '$price',
            image_name ='$image_name',
            category_id ='$category_id',
            featured='$featured',
            active='$active'
            ";

            //3.Execute Query and save Data into Databse /////////////////////////////////////////////////

            $res = mysqli_query($conn, $sql2);

            // 4.Check wether the data is inserted or not and disply appropriate message /////////////////

            if ($res == TRUE) {

                // echo 'Data inserted';

                //Create a Session Variable to Display Message
                $_SESSION['add-new-food'] = "<div class='success'> New Food Added Successfully </div>";

                //Redirect Page to Manage Admin 
                header("location:". SITE_URL."admin/manage-food.php");
                ob_end_flush();

            } else {

                // echo 'Data not inserted';

                //Create a Session Variable to Display Message
                $_SESSION['add-new-food'] = "<div class='error'> Failed to add category </div>";

                //Redirect Page to Manage Admin 
                header("location:".SITE_URL."admin/add-food.php");
                ob_end_flush();
            }
        }

        ?>