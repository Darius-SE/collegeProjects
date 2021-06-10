<?php

require_once "include/classes.inc.php";

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

/*if(!isset($_SESSION['user']))
{
    header("Location: home.php");
}
else
{*/
/*  $user = unserialize($_SESSION['user']);
  if(!($user->isAdmin()))
  {
    header("Location: home.php");
  }
}*/

if(isset($_GET['values']))
{
  $arr = $_GET['values'];
  $arr = explode(",",$arr);
  $arr = array_filter($arr);
  //print_r($arr);
  foreach($arr as $productId)
  {
    $user->accessCart()->removeFromCart($productId);

  }

}
elseif(isset($_POST['entry']) and isset($_POST['productId']))
{
    $i = 0;
    //print_r($_POST['entry']);
    //print_r($_POST['productId']);
    $proIds = $_POST['productId'];
    $quants = $_POST['entry'];
    foreach ($proIds as $id)
    {
      $user->accessCart()->changeQuantity($id, $quants[$i]);
      $i++;
    }
    //echo $user->accessCart()->getAmount();
    header("Location: placeOrder.php");





}
else
{
   //echo "Not set";
}








function sanitize($var)
{
  $var = trim($var);
  $var = stripslashes($var);
  $var = strip_tags($var);
  $var = htmlentities($var);
  return $var;

}
