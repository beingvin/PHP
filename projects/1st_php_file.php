<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>1st php file</title>
  </head>
  <style media="screen">
    * {
       margin: 0;
       box-sizing: border-box;
    }

    h1 {
      background: grey;
      text-align: center;

    }

  </style>
  <body>


    <div class="container">

      <h1>php Tutorial</h1><br>

      <h3>php data types :</h3><br>
      <?php
        $var = "This is a string";
        $bool = True and True;
        $num1 = 50;
        $num2 = 44;
        $float = 15.25;
        $array = array("apple", "mango", "banana", "jackfruit", "blackberry", "blueberry");
        //$objact



        echo $var; echo "<br/>";

        echo var_dump($bool);  echo "<br/>";

        echo "This is a boolian value -  "; echo $num1 + $num2; echo "<br/>";

        echo "This is a float value - "; echo $float; echo "<br/>";

        echo "This is a array -  "; echo $array ; echo "<br/>";

       ?>

    </div>

  </body>
</html>
