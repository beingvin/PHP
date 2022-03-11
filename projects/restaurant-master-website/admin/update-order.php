<?php
ob_start();

include('partials/menu.php'); ?>


<!-- Main content section starts  -->

<div class="main-content">
    <div class="wrapper">

        <h1>Update Order</h1> <br>

        <br>

        <!-- Get  data from the database starts  -->

        <?php


        if (isset($_GET['id'])) {

            //1.Get the ID  of the order to be updated
            $id = $_GET['id'];

            //2.Create query to update order
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

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
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                } else {

                    //Redirect to manage order page with error message
                    header("location:" . SITE_URL . 'admin/manage-order.php');
                    $_SESSION['order-not-found'] = "<div class='error'>  Order not found try again. </div>";
                }
            }
        } else {
            //Redirect to manage category page with error message
            header("location:" . SITE_URL . 'admin/manage-order.php');
            $_SESSION['order-not-found'] = "<div class='error'>  Order not found try again.. </div>";
        }

        ?>

        <!-- Get data from the database ends  -->


        <!-- manage oders table -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-50">

                <tr>
                    <td>Food Name :</td>
                    <td> <b><?php echo $food; ?></b> </td>

                </tr>

                <tr>
                    <td>Price :</td>
                    <td><b><?php echo $price; ?></b></td>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                </tr>


                <tr>
                    <td>Qty:</td>
                    <td><input class="input" type="number" name="qty" value="<?php echo $qty; ?>"> </td>

                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select class="input" name="status">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") {
                                        echo "selected";
                                    } ?> value="On Delivery">On
                                Delivery</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered
                            </option>
                            <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled
                            </option>
                        </select>
                    </td>
                </tr>

                <tr>

                    <td>Customer Name :</td>

                    <td><input class="input" type="text" name="customer-name" value="<?php echo $customer_name; ?>">
                    </td>

                </tr>

                <tr>

                    <td>Customer Contact:</td>
                    <td><input class="input" type="text" name="customer-contact"
                            value="<?php echo $customer_contact; ?>">
                    </td>

                </tr>

                <tr>

                    <td>Customer Email:</td>
                    <td><input class="input" type="text" name="customer-email" value="<?php echo $customer_email; ?>">
                    </td>


                </tr>

                <tr>

                    <td>Customer Address:</td>
                    <td> <textarea class="input" cols=30 rows="10"
                            name="customer-address"><?php echo $customer_address; ?> </textarea> </td>


                </tr>

                <tr>

                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update-Order" class="submit-btn">
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

    //1.Get all the values from form  
    $id = $_POST['id'];
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $total = $price * $qty; // To get total calculate total = price * qty 

    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer-name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer-contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer-email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer-address']);

    //2.Create a sql query to update order
    $sql2 = "UPDATE tbl_order SET        
                            price ='$price', 
                            qty ='$qty', 
                            total = '$total', 
                            order_date = '$order_date', 
                            status = '$status', 
                            customer_name ='$customer_name', 
                            customer_contact ='$customer_contact', 
                            customer_email='$customer_email', 
                            customer_address = '$customer_address'
                            
            WHERE id = '$id'
            ";

    //3.Execute the query 
    $res = mysqli_query($conn, $sql2);

    //4.Check wether the data is inserted or not and disply appropriate message
    if ($res == TRUE) {

        //Create a Session Variable to Display Message
        $_SESSION['update-order'] = "<div class='success'> Order Updated Successfully </div>";
        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . "admin/manage-order.php");
        ob_end_flush();
    } else {

        //Create a Session Variable to Display Message
        $_SESSION['update-order'] = "<div class='error'> Failed to update order </div>";
        //Redirect Page to Manage Admin 
        header("location:" . SITE_URL . "admin/manage-order.php");
        ob_end_flush();
    }
}

?>