<?php
include('../config/constants.php');


//1.Get the ID of the admin to be deleted 
$id = $_GET['id'];

//2.Create query to delete admin 
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//3.Execute the query

$res = mysqli_query($conn, $sql);



//4.Check whether the query is success or failed
//5.Redirect to manage admin page with message (success/error)

if ($res == TRUE) {

    // echo 'Admin deleted successfully';

    //Create a Session Variable to Display Message
    $_SESSION['delete-admin'] = "<div class='success' > Admin deleted successfully </div>";
    //Redirect Page to Manage Admin 
    header("location:" . SITE_URL .'admin/manage-admin.php');

} else {

    // echo 'Failed to delete Admin ';

    //Create a Session Variable to Display Message
    $_SESSION['delete-admin'] = "<div class='error' >Failed to delete Admin </div>";
    //Redirect Page to Manage Admin 
    header("location:" . SITE_URL .'admin/manage-admin.php');

}




    