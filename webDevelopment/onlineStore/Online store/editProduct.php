<?php
require "header.php";
require_once "include/classes.inc.php";
require "./include/editProduct.inc.php";
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if(!isset($_SESSION['user']))
{
  header("Location: home.php");
}
else
{
  $user = unserialize($_SESSION['user']);
  if(!($user->isAdmin()))
  {
    header("Location: home.php");
  }
}

if(isset($_SESSION['product']))
{
  $product = unserialize($_SESSION['product']);
}
else
{
    header("Location: home.php");
}



 ?>

 <div class="container">
   <div class="main">


     <div class="SignUp-form">
     <form class="" action="editProduct.php" method="post"  enctype="multipart/form-data">
       <h1 >Edit Product</h1>

       <div class="error-addProduct"> <?php echo $nameError; ?></div>
       <?php
     if(empty($nameError))
     {
     echo "<input type='text' name='name' placeholder='Product Name'  value=\"" .   $product->getName() . "\">";
     }
     else
     {
     echo "<input class = 'error-input' type='text' name='name' placeholder='Product Name' value=\"" .  $product->getName() . "\">";
     }
     ?>

    <div class="error-readonly"> Product ID cannot be changed</div>
    <?php

    echo "<input type='text' name='id' placeholder='Product ID' value=\"" . $product->getProductId() . "\" readonly>";

    ?>

    <div class="error-addProduct"> <?php echo $priceError; ?></div>
    <?php
    if (empty($priceError))
    {
    echo "<input type='text' name='price' placeholder='Price' value=\"" . $product->getPrice() . "\">";
    }
    else
    {
    echo "<input class = 'error-input' type='text' name='price' placeholder='Price'  value=\"" . $product->getPrice() . "\">";
    }

    ?>
    <div class="error-addProduct"> <?php echo $quantityError; ?></div>
    <?php
    if (empty($quantityError))
    {
    echo "<input type='text' name='quantity' placeholder='Quantity' value=\"" . $product->getQuantity() . "\">";
    }
    else
    {
    echo "<input class = 'error-input' type='text' name='quantity' placeholder='Quantity'  value=\"" . $product->getQuantity() . "\">";
    }
    ?>

     <div class="error-addProduct"> <?php echo $picError; ?></div>
     <?php
     echo "<input type='File' name='pic'>";
     ?>
     <div class="error-addProduct"> <?php echo $descError; ?></div>
     <?php
      $desc = $product->getDescription();
     if (empty($descError))
     {
     echo "<textarea  class = 'desc' name='desc' rows='1' cols='50' wrap='physical' placeholder='Description'>" . "$desc" ."</textarea>";

     }
     else
     {

     echo "<textarea  class = 'desc-error' name='desc' rows='1' cols='50' wrap='physical' placeholder='Description'>" . " $desc " . "</textarea>";
     }
     ?>

       <input type="submit" name="submit-edit" value="Submit" class="signUp-butn">

       </form>
       </div>


</div>
</div>

  <input type="button" name="checkout" value="Go Back" class="checkout" onclick="location.href = 'removeProductForm.php';">

<?php require "footer.php" ?>
</body>

</html>
