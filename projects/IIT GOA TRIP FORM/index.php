<?php
    $insert = false;
    if(isset($_POST['name'])){

        // set connection veriables
        $server = "localhost";
        $username = "root";
        $password =  "";
        $connection = mysqli_connect($server, $username, $password);

        // create a database connection 
        if (!$connection) {
            die("connection to this db failed due to ". mysqli_connect_error());
        };
        echo "<p style='background-color: white;'>Successfully connected to the db</p>";

        // collect post variables 
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $other = $_POST['other'];

        $sql = "INSERT INTO `europe_trip`.`trip` (`sno`, `name`, `age`, `gender`, `email`, `phone`, `other`, `date`) VALUES (NULL, '$name', '$age', '$gender', '$email', '$phone', '$other', CURRENT_TIMESTAMP)";
        
        // execute the query 
        if ($connection->query($sql)==true){
            $insert = true;
        }
        else{
            echo "error : $sql <br> $connection->error";
        }
        // close the database connection
        $connection->close();
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIT goa trip form</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <div class="container">
        <h3>WELCOME TO IIT GOA </h3>
        <h1>EUROPE TRIP REGISTRATION</h1>
        <p>Enter your details and submit this form to conform your participation in the trip</p>
        <?php
        if($insert == true) {
           echo "<p class='flag'>Thanks for submitting your form. We are happy to see you joinning us for the europe trip</p>";
        };
        ?>
        
        <form action="index.php" method="post" >
            <input type="text" name="name" id="name" placeholder="Enter your name " required ><br>
            <input type="text" name="age" id="age" placeholder="Enter your age " required><br>
            <input type="text" name="gender" id="gender" placeholder="Enter your gender" required><br>
            <input type="email" name="email" id="email" placeholder="Enter your email id " required><br>
            <input type="phone" name="phone" id="phone" placeholder="Enter your phone no " required><br>
            <textarea name="other" id="other" cols="30" rows="5" placeholder="Enter any other information here"></textarea><br>
            <button type="submit">Submit</button><br>
            <button type="reset">Reset</button>
        </form>
    </div>



    


</body>
</html>