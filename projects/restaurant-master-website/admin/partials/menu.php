<?php
include("../config/constants.php");
include("user-session.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Restaurant Project</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>


    <!-- menu section start   -->
    <div class="menu">
        <div class="wrapper">

            <ul>

                <li> <a href="home.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Catagory</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li> <?php
                        $active_user = $_SESSION['user'];
                        echo "<p class='active_user'> $active_user</p>";

                        ?> </li>

            </ul>
        </div>

    </div>

    <!-- menu section ends   -->