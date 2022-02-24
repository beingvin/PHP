<?php include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Update Category</h1> <br>

        <br>

        <?php

        $id = $_GET['id'];

        //2.Create query to delete admin 

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
                $featured = $row['featured'];
                $active = $row['active'];

            }
        }

        ?>

        <!-- manage oders table -->
        <form action="" method="POST">

        <table class="tbl-50">


<tr>
    <td>Title :</td>
    <td> <input class="input" type="text" name="title" placeholder="Category title" value="<?php echo $title; ?>" >  </td>

</tr>

<tr>
    <td>Featured :</td>
    <td> <input  type="radio" name="featured" value="Yes"  > Yes
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
         <input type="hidden" name="id" value="<?php echo $id; ?>" >
        <input type="submit" name="submit" value="Update-Category" class="submit-btn">
    </td>

</tr>

</table>

        </form>


    </div>

</div>

<!-- Main content section ends  -->


<?php include('partials/footer.php'); ?>


<?php

if (isset($_POST['submit'])) {

    //Get all the values from form
    echo $id = $_POST['id'];
    $title = $_POST['title'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //Create a sql query to update category
    $sql = "UPDATE tbl_category SET 
            title='$title',
            featured='$featured',
            active='$active'
            WHERE id = '$id'
            ";

    // Execute the query 

    $res = mysqli_query($conn, $sql);

    //Check wether the data is inserted or not and disply appropriate message
    if ($res == TRUE) {

        //Create a Session Variable to Display Message
        $_SESSION['update'] = "<div class='success'> category Updated Successfully </div>";
        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/manage-category.php');
    } else {

        //Create a Session Variable to Display Message
        $_SESSION['update'] = "<div class='error'> Failed to update category </div>";
        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . 'admin/manage-category.php');
    }
}






?>