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
                    <td>Image :</td>
                    <td> <input type="text" name="image"> </td>

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
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //2.SQL query to save data into Database

    $sql = "INSERT INTO tbl_category SET 
            title='$title',
            featured='$featured',
            active='$active'
            ";

    // echo $sql;

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