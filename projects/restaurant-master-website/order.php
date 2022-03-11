<?php

include("partials-front/header.php");
include("config/constants.php");

if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    $sql = " SELECT * from tbl_food WHERE id=$food_id ";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);

        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } 
    else {
        header("location:" . SITE_URL . 'index.php');
    }
} 
else {
    header("location:" . SITE_URL . 'index.php');
}

?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <?php 
         if (isset($_SESSION['order-failed'])) {

            echo $_SESSION['order-failed']; //Displaying Session Message
            unset($_SESSION['order-failed']); // removing Session Message

        }
        ?>
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>



        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
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
                    <img src=" <?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>"
                        alt="<?php echo $title; ?>" class="img-responsive img-curve">
                    <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>
                <?php
                ?>
            </fieldset>


            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required> </textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


<?php

if (isset($_POST['submit'])) {

    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = mysqli_real_escape_string($conn,$_POST['qty']); 
    $total = $price * $qty; // To get total calculate total = price * qty 
    $order_date = date("Y-m-d h:i:sa") ; // Order date
    $status = "Ordered";
    $customer_name = mysqli_real_escape_string($conn,$_POST['full-name']);
    // $customer_name = $_POST['full-name'];
    $customer_contact = mysqli_real_escape_string($conn,$_POST['contact']);
    $customer_email = mysqli_real_escape_string($conn,$_POST['email']);
    $customer_address =mysqli_real_escape_string($conn,$_POST['address']);
    


    //Write sql query and execute
    $sql2 = "INSERT INTO tbl_order SET 
                                    food='$title',
                                   price ='$price', 
                                   qty ='$qty', 
                                   total = '$total', 
                                    order_date = '$order_date', 
                                   status = '$status', 
                                    customer_name ='$customer_name', 
                                    customer_contact ='$customer_contact', 
                                    customer_email='$customer_email', 
                                   customer_address = '$customer_address'
                                   ";
    $res2 = mysqli_query($conn, $sql2);

    if($res2 == True){
          // echo 'Data inserted';

                //Create a Session Variable to Display Message
                $_SESSION['order'] = "<div class='success'> Order placed successfully </div>";

                //Redirect Page to Manage Admin 
                header("location:". SITE_URL."index.php");
    }else {

        //Create a Session Variable to Display Message
        $_SESSION['order-failed'] = "<div class='error'> Failed to place order please try again. </div>";

        //Redirect Page to Manage Admin 
        header("location:".SITE_URL."order.php");
    }

    
}

?>


<?php

include("partials-front/footer.php");

?>