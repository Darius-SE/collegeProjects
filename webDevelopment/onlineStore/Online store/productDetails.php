<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$_SESSION['nav'] = "products";
require "header.php";
require_once "include/classes.inc.php";
$inv = new Inventory();
if(isset($_POST['productId']))
{
  $productid = $_POST['productId'];
}
require "./include/AddToCart.inc.php";

$isCustomer = false;
if(isset($_SESSION['user']))
{
	$user = unserialize($_SESSION['user']);
  if(!($user->isAdmin()))
  {
    $isCustomer = true;
  }
	else
	{
		$isCustomer = false;
	}
}
else
{
  	$isCustomer = false;
}

if(isset($_GET['id']))
{
  $productid = $_GET['id'];
  $product = $inv->SearchInventory($productid);
}
elseif(isset($_SESSION['productId']))
{

 $productid = $_SESSION['productId'];
 $product = $inv->SearchInventory($productid);

}
else
{
  header("location: home.php");
}

//echo $productid;



?>

<div class="container">
  <div class="main">
<div class="row">

	<div class="col-md4">
		<img src="<?php echo $product->getPicture(); ?>" style="height: 576px; width: 678px" class = "pro-det-img">
		<h5>Rating: </h5> <?php
      $rating = round($product->getAverageRating());
    	for ($i = 1; $i <= $rating; $i++)
      {
        echo "<i class='fa fa-star'></i>";
      } ?>
    </div>





	<div class="col-md8">
		<h3><?php echo $product->getName(); ?></h3>
		<div class="price">
		<h4>Price: $<?php echo $product->getPrice(); ?></h4>
		</div>
		<div class="description">
			<h5><?php echo $product->getDescription(); ?></h5>
		</div>
    <div class="price">
    <h4><?php echo $inv->getInventoryQuantity($product->getProductId()); ?> left in stock</h4>
    </div>
<?php if($isCustomer)
{?>
		<div class="productDetails">
			<form method="post" action="productDetails.php">
          <input type='hidden'   name='productId' value='<?php echo $product->getProductId(); ?>'>
          <div class= "error-sign"> <?php echo $qtyError; ?></div>
          <?php if($inv->getInventoryQuantity($product->getProductId()) >= 1) {?>
				QTY: <input class="qty" type="number" name="qty" value="1" min = "1" max = "<?php echo $inv->getInventoryQuantity($productid);?>">
				<button type="submit" name="addCart" class="btn btn-primary" style = "margin-left: 10px;">Add to Cart</button>
      <?php }
      else {?>
        <div class="price">
        <h4>OUT OF STOCK</h4>
        </div>

    <?php  }?>

          <div class= "error-sign"> <?php echo $qtyError; ?></div>
			</form>
		</div>
  <?php } ?>
	</div>

</div>
</div>

</div>
<?php require "footer.php" ?>
</body>

</html>
