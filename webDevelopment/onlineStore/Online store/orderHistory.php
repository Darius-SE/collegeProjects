<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "order";
require "header.php";


if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if(isset($_SESSION['user']))
{
  $user = unserialize($_SESSION['user']);
  if($user->isAdmin())
  {
  header("Location: home.php");
  }
}
else
{
    header("Location: home.php");

}

$arr = array();
$arr = $user->getOrderHistory();
$prods = $arr[0];
$ids = $arr[1];
//print_r($arr);
//print_r($prods);
//print_r($ids);


$order = new Order($user->getID());
?>

<div class="container">
  <div class="main">

    <?php
    $index = 0;
    foreach ($prods as $item)
    {?>

  <div class="cart">
    <div class="helper">
      <img src="<?php echo $item->getPicture(); ?>" style="width: 400px;" alt="photo">
      </div>
    <div class="form">


      <span> <strong>OrderId:</strong> <?php echo $ids[$index]; ?></span>
      <span> <strong>Name:</strong> <?php echo $item->getName(); ?></span>
      <span><strong>Description:</strong> <?php echo $item->getDescription(); ?></span>
      <span><strong>Price:</strong> $<?php echo $item->getPrice(); ?></span>
      <span><strong>Quantity:</strong> <?php echo $item->getQuantity(); ?></span>
      <span><strong>Date of Purchase:</strong> <?php echo $order->getDateOfPurchase($ids[$index]); ?></span>
      </div>
      </div>
        <?php
        $index++;
        }?>



</div>


</div>

<?php require "footer.php" ?>
</body>

</html>
