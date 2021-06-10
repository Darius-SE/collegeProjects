<?php
require "header.php";
require_once "include/classes.inc.php";
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
  if(isset($_POST['remove']))
  {
    $inv = new Inventory();
    $inv->removeProduct($product->getProductId());
    unset($_SESSION["products"]);
    header("Location: manageInventory.php");

  }
}
else
{
    header("Location: home.php");
}



 ?>

 <div class="container">
   <div class="main">


 <div class="cart">
 <div class="helper">
   <img src="<?php echo $product->getPicture(); ?>" alt="photo">
   </div>
   <div class="form">
   <form action="removeProduct.php" method="post">
     <span>Name: <?php echo $product->getName(); ?></span>
     <span>Description: <?php echo $product->getDescription(); ?></span>
     <span>Price: $<?php echo $product->getPrice() ?></span>
     <span>Quantity: <?php  echo $product->getQuantity() ?></span>
     <input class = "remove" type="submit" name="remove" value="Remove">
   </form>
     </div>
 </div>


</div>
</div>

  <input type="button" name="checkout" value="Go Back" class="checkout" onclick="location.href = 'removeProductForm.php';">

<?php require "footer.php" ?>
</body>

</html>
