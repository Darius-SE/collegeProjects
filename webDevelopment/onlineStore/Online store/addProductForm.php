<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "manage";
require "header.php";
require "./include/addProduct.inc.php";

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
 ?>

 <body>
<div class="container">
 <div class="main">



   <div class="SignUp-form">
   <form class="" action="addProductForm.php" method="post"  enctype="multipart/form-data">
     <h1 >Add Product</h1>

     <div class="error-addProduct"> <?php echo $nameError; ?></div>
     <?php
   if(empty($nameError))
   {
   echo "<input type='text' name='name' placeholder='Product Name'  value=\"" . $name . "\">";
   }
   else
   {
   echo "<input class = 'error-input' type='text' name='name' placeholder='Product Name' value=\"" . $name . "\">";
   }
   ?>

 <div class="error-addProduct"> <?php echo $idError; ?></div>
 <?php
 if (empty($idError))
 {
 echo "<input type='text' name='id' placeholder='Product ID' value=\"" . $id . "\">";
 }
 else
 {
 echo "<input class = 'error-input' type='text' name='id' placeholder='Product ID'  value=\"" . $id . "\">";
 }
 ?>

 <div class="error-addProduct"> <?php echo $priceError; ?></div>
 <?php
 if (empty($priceError))
 {
 echo "<input type='text' name='price' placeholder='Price' value=\"" . $price . "\">";
 }
 else
 {
 echo "<input class = 'error-input' type='text' name='price' placeholder='Price'  value=\"" . $price . "\">";
 }

 ?>
 <div class="error-addProduct"> <?php echo $quantityError; ?></div>
 <?php
 if (empty($quantityError))
 {
 echo "<input type='text' name='quantity' placeholder='Quantity' value=\"" . $quantity . "\">";
 }
 else
 {
 echo "<input class = 'error-input' type='text' name='quantity' placeholder='Quantity'  value=\"" . $quantity . "\">";
 }
 ?>

   <div class="error-addProduct"> <?php echo $picError; ?></div>
   <?php
   echo "<input type='File' name='pic'>";
   ?>
   <div class="error-addProduct"> <?php echo $descError; ?></div>
   <?php
   if (empty($descError))
   {
   echo "<textarea  class = 'desc' name='desc' rows='1' cols='50' wrap='physical' placeholder='Description' value=\"" . $description . "\"></textarea>";
   }
   else
   {
   echo "<textarea class = 'error-input-desc'  rows='1' cols='50' wrap='physical' name='desc' placeholder='Description'  value=\"" . $description . "\"></textarea>";

   }
   ?>

     <input type="submit" name="submit-addProduct" value="Add Product" class="signUp-butn">

     </form>
     </div>

 </div>
   </div>
   <input type="button" name="checkout" value="Go Back" class="checkout" onclick="location.href = 'manageInventory.php';">
   <?php require "footer.php" ?>
 </body>

 </html>
