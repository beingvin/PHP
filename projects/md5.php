<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>

    <!-- manage oders table -->
    <form action="" method="POST">

<table class="tbl-50">



    <tr>
        <td>Current Passowrd :</td>
        <td> <input class="input" type="password" name="current_password" placeholder="current Password"> </td>

    </tr>

    <tr>
        <td>New Password :</td>
        <td> <input class="input" type="password" name="new_password" placeholder="New Password"> </td>

    </tr>

    <tr>
        <td>Confirm Password :</td>
        <td> <input class="input" type="password" name="confirm_password" placeholder="Confirm Password"> </td>

    </tr>

    <tr>

        <td colspan='2'>
            <input type="hidden" name="id" value="<?php echo $id; ?>" class="submit-btn">

            <input type="submit" name="submit" value="Change Password" class="submit-btn">
        </td>

    </tr>

</table>

</form>

    </div>

    <?php 
    
        if (isset($_POST['submit'])){

            echo '<br>';

            echo 'Submit Button Pressed';
            
            echo '<br>';

          

            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            echo $new_password;
            echo '<br>';
            echo $confirm_password;

            echo '<br>';
            
            if ($new_password == $confirm_password){

                echo 'both are same';
            }
            else {
                echo 'both are not same';
            }

        }



    ?>

</body>
</html>