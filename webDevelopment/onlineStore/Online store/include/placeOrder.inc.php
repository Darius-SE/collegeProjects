<?php
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
  if($user->isAdmin())
  {
    header("Location: home.php");
  }
  //echo $user->getID();
}








$inv = new Inventory();
$id = $user->getID();
$amount =  $user->accessCart()->getAmount();
$order = new Order($id, $amount);
$name = "";
$credit = "";
$expMonth = "";
$expYear  = "";
$ccv = "";
$creditError = "";
$nameError = "";
$expMonthError = "";
$expYearError = "";
$ccvError = "";
$error = false;



if (isset($_POST['submit-placeOrder']))
{
  $name = sanitize($_POST['name']);

  $credit = sanitize($_POST['credit']);


  $expMonth = sanitize($_POST['expMonth']);


  $expYear = sanitize($_POST['expYear']);


  $ccv = sanitize($_POST['ccv']);



  if(empty($name))
  {
      $nameError = "Name must be entered";
      $error = true;
  }
  elseif (!preg_match('/^[a-zA-Z ]+$/', $name))
  {
    $nameError = "Name must only consist of letters";
    $error = true;
  }


  if(empty($credit))
  {
      $creditError = "Card number field must be filled out";
      $error = true;
  }
  elseif (!preg_match('/^4[0-9]{12}(?:[0-9]{3})?|3[47][0-9]{13}$/', $credit))
  {
    $creditError = "Invalid credit card number";
    $error = true;
  }

  if(empty($expMonth))
  {
      $expMonthError = "Expiration month must be enetered";
      $error = true;
  }


  if(empty($expYear))
  {
      $expYearError = "Expiration Year must be enetered";
      $error = true;
  }

  if(empty($ccv))
  {
      $ccvError = "CCV is required";
      $error = true;
  }
  elseif (!preg_match('/^[0-9]{3,4}$/', $ccv))
  {
    $ccvError = "Invalid format";
    $error = true;
  }


  if(!$error)
  {

    $order->placeOrder($user->accessCart()->getCartItems());
    $user->accessCart()->clearCart();
    header("Location: home.php");

  }


}

function sanitize($var)
{
  $var = trim($var);
  $var = stripslashes($var);
  $var = strip_tags($var);
  $var = htmlentities($var);
  return $var;

}
