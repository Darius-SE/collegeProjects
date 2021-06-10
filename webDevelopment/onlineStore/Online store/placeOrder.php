<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$_SESSION['nav'] = "cart";
require "header.php";


require_once "./include/placeOrder.inc.php";



/*if(!isset($_SESSION['user']))
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

}*/
?>


<div class="container">
  <div class="main">



<div class="placeOrder-form">
<form class="" action="placeOrder.php" method="post">
  <h1 >Place your order!</h1>


  <div class="money">


  
  <div class="info">
  <span >Sub total:</span> <span style="margin-left: 15px;">$<?php echo $order->getSubTotal();?></span>
  </div>
  <div class="info">
  <span >Federal Tax:</span> <span style="margin-left: 15px;">$<?php echo $order->getFedTax();?></span>
  </div>
  <div class="info">
  <span >Tax:</span> <span style="margin-left: 15px;">$<?php echo $order->getTax();?></span>
  </div>
  <div class="info">
  <span >Total:</span> <span style="margin-left: 15px;">$<?php echo $order->getTotal();?></span>
  </div>

  </div>
  <div class="error-sign"> <?php echo $nameError; ?></div>

  <?php
if(empty($nameError))
{
echo "<input type='text' name='name' placeholder='Name on card'  value=\"" . $name . "\">";
}
else
{
echo "<input class = 'error-input' type='text' name='name' placeholder='Name on card' value=\"" . $name . "\">";
}
?>


<div class= "error-sign"> <?php echo $creditError; ?></div>
<?php
if (empty($creditError))
{
echo "<input type='text' name='credit' placeholder='Credit Card Number' value=\"" . $credit . "\">";
}
else
{
echo "<input class = 'error-input' type='text' name='credit' placeholder='Credit Card Number'  value=\"" . $credit . "\">";
}
?>


<div class="error-sign"> <?php echo $expMonthError; ?></div>
<?php
if (empty($expMonthError))
{
echo "<input class = 'expMonthInput' type='Number'  min='1' max = '12' name='expMonth' placeholder='Expiration Month: ##' value=\"" . $expMonth . "\">";
}
else
{
echo "<input class = 'expMonth-error-input' min='1' max = '12' type='Number' name='expMonth' placeholder='Expiration Month: ##'  value=\"" . $expMonth . "\">";
}

?>



<div class="error-sign"> <?php echo $expYearError; ?></div>
<?php
if (empty($expYearError))
{
echo "<input class = 'expMonthInput'  min='2019' max = '2030' type='number' name='expYear' placeholder='Expiration Year: ####' value=\"" . $expYear . "\">";
}
else
{
echo "<input class = 'expMonth-error-input'  min='2019' max = '2030' type='number' name='expYear' placeholder='Expiration Year: ####'  value=\"" . $expYear . "\">";
}
?>



<div class="error-sign"> <?php echo $ccvError; ?></div>
<?php
if (empty($ccvError))
{
echo "<input type='text' class= 'input-cvv' name='ccv' placeholder='CCV: ###' value=\"" . $ccv . "\">";
}
else
{
echo "<input class = 'error-input' type='text' name='ccv' placeholder='CCV: ###'  value=\"" . $ccv . "\">";
}
?>
<div class="sub">


  <input type="submit" name="submit-placeOrder" value="Place Order" class="signUp-butn">
</div>
  </form>
</div>








</div>
</div>
<?php require "footer.php" ?>
</body>

</html>
