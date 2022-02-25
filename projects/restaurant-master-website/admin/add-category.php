<?php include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Add Category</h1> <br>

         <?php
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category']; //Displaying Session Message
            unset($_SESSION['add-category']); // removing Session Message
        }
        elseif (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //Displaying Session Message
            unset($_SESSION['upload']); // removing Session Message
        } 

        ?>




        <br>

        <!-- manage oders table -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-50">


                <tr>
                    <td>Title :</td>
                    <td> <input class="input" type="text" name="title" placeholder="Category title"> </td>

                </tr>

                <tr>
                    <td>Select Image :</td>
                    <td> <input type="file" name="image"> </td>

                </tr>

                <tr>
                    <td>Featured :</td>
                    <td> <input  type="radio" name="featured" value="Yes"> Yes
                        <input  type="radio" name="featured" value="No" > No 
                    </td>
                   
                </tr>

                <tr>
                    <td>Active :</td>
                    <td> <input  type="radio" name="active" value="Yes"> Yes
                        <input  type="radio" name="active" value="No" > No 
                    </td>
                </tr>

                <tr>

                    <td colspan='2'>
                        <input type="submit" name="submit" value="Add-Category" class="submit-btn">
                    </td>

                </tr>

            </table>

        </form>


    </div>

</div>

<!-- Main content section ends  -->

<?php include('partials/footer.php'); ?>


<?php

//Process the value from form and save it in to Databse
// Check wether submit button is clicked or not

if (isset($_POST['submit'])) {
    // echo 'Button clicked';

    //1.Get the data from the form 

    $title = $_POST['title'];

    //Check if featured redio button is selected ot not 
    if(isset($_POST['featured'])){
        //Get the value from form
        $featured = $_POST['featured'];
    }   
    else {
        //Set defualt value as "No"
        $featured = 'No';
    }

     //Check if active redio button is selected ot not 
     if(isset($_POST['active'])){
        //Get the value from form
        $active = $_POST['active'];
    }
    else {
        //Set defualt value as "No"
        $active  = 'No';
    }

    //Check if image is selected or no and set the value for image name
    
    // print_r($_FILES['image']);

    // die(); // break the code here

    if(isset($_FILES['image']['name'])){
        // Get image file name
        $image_name = $_FILES['image']['name'];
        //Get image file path

        //Get the extention of the image (.jpg, .gif, .pnp, etc) to autorename image file name
        $ext = end(explode('.',$image_name));

        //rename image file name 
        $image_name ="Food_Category_".rand(000, 999).'.'.$ext; //e.g Food_category_544.jpg



        $source_path = $_FILES['image']['tmp_name'];
        //Set the destiation path 
        $destination_path = "../images/category/".$image_name;
        //upload the image
        $upload = move_uploaded_file($source_path, $destination_path);
        
        if ($upload == FALSE){
            //Create a Session Variable to Display Message
            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image </div>";
            //Redirect Page to Manage Admin 
            header("location:" . SITE_URL . 'admin/add-category.php');
            die(); // break the code here
        }
    }
    else {
        //if image not upoaded set image name as blank
        $image_name = '';
    }



    //2.SQL query to save data into Database

    $sql = "INSERT INTO tbl_category SET 
            title='$title',
            image_name ='$image_name',
            featured='$featured',
            active='$active'
            ";

    //3.Execute Query and save Data into Databse

    $res = mysqli_query($conn, $sql);

    //4.Check wether the data is inserted or not and disply appropriate message
    if ($res == TRUE) {
        // echo 'Data inserted';

        //Create a Session Variable to Display Message
        $_SESSION['add-category'] = "<div class='success'> New Category Added Successfully </div>";
        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/manage-category.php');
    } else {
        // echo 'Data not inserted';
        //Create a Session Variable to Display Message
        $_SESSION['add-category'] = "<div class='error'> Failed to add admin </div>";
        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/add-category.php');
    }
}



?>