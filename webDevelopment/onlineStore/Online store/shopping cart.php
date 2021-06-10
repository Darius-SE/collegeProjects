

<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$_SESSION['nav'] = "cart";
require "header.php";
require "./include/proccessCheckout.inc.php";


if(!isset($_SESSION['user']))
{
  header("Location: home.php");
}
else
{
  $user = unserialize($_SESSION['user']);
  if($user->isAdmin())
  {
    header("Location: home.php");
  }
}



/*if(!isset($_SESSION['user']))
{
  header("Location: home.php");
}

$user = unserialize($_SESSION['user']);*/


$arr = array();
$arr = $user->accessCart()->getCartItems();
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['cart'] = $arr;
$inv = new Inventory();
//print_r($arr);
?>


<div class="container">
<div class="main">
    <form method ='post' id = "quantities" action='shopping cart.php'>
  <?php
  $index = 0;
  foreach ($arr as $item)
  {
    if(($inv->getInventoryQuantity($item->getProductId() >= 1)))
    {
      $user->accessCart()->removeFromCart($item->getProductId());
      header("Location: shopping cart.php");

    }
    ?>

<div class="cart">
<div class="helper">
  <img src="<?php echo $item->getPicture(); ?>" style="width: 400px;" alt="photo">
  </div>
  <div class="form">

    <span> <strong>Name:</strong> <?php echo $item->getName(); ?></span>
    <span><strong>Description:</strong> <?php echo $item->getDescription(); ?></span>
    <span><strong>Price:</strong> $<?php echo $item->getPrice(); ?></span>
    <span><strong>Quantity:</strong></span>
    <input type='hidden'  id = "productId1"  value='<?php echo $item->getProductId(); ?>'>
      <input type='hidden'   name='productId[]' value='<?php echo $item->getProductId(); ?>'>

    <INPUT TYPE="NUMBER" MIN="1" MAX="<?php echo $inv->getInventoryQuantity($item->getProductId()); ?>"  name = "entry[]" STEP="1" VALUE="<?php echo $item->getQuantity(); ?>" required>
      <div class="remove">
        <span>Remove?<input  class = "checkboxes" type="checkbox" name="boxes[]" value="<?php echo $item->getProductId(); ?>"></span>
      </div>



    </div>
</div>



<?php
  $index++;
}?>
</form>
<?php
if(empty($arr)){?>
<h1 style="text-align: center; margin-top: 15%; ">No Products in Shopping Cart</h1>
<?php } ?>
</div>
</div>
<?php if(!empty($arr))
  {?>
  <input type="button" onclick="submitForms()" name="checkout" value="Check Out" class="checkout">
  <input type="button" onclick="remove()" name="remove" value="Remove Selected Items" class="removeButton">
<?php } ?>
<?php require "footer.php" ?>
<script >
submitForms = function(){
  document.getElementById("quantities").submit();
}
</script>

<script>

remove = function ()
{
  var checks = document.getElementsByClassName('checkboxes');
  var arr = [];
  for (i = 0; i < checks.length; i++)
  {
    if (checks[i].checked == true)
    {
      arr[i] = checks[i].value;
    }
  }
  window.location.href='shopping cart.php?values='+arr;
}

</script>



</body>
</html>
