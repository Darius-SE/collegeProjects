<?php

$qty = "";
$qtyError = "";
$error = false;


if(isset($_POST['addCart']))
{
  $qty = sanitize($_POST['qty']);

  if(empty(  $qty ))
  {
    $qtyError = "A quantity amount must be entered";
    $error = true;
  }
  elseif (!filter_var($qty, FILTER_VALIDATE_INT))
  {
    $qtyError = "A quantity amount must an integer";
    $error = true;
  }
  elseif (($qty <= 0 or $qty > ($inv->getInventoryQuantity($productid))))
  {
    echo $qty;

    $qtyError = "Quantity must be between 1 and " . ($inv->getInventoryQuantity($productid));
    $error = true;
  }

  if(!$error)
  {
    /*if ($user->accessCart() == null)
    {
      echo "null";
    }
    else {
      echo "wow";
    }*/
    echo $productid;
     $user->accessCart()->addToCart($productid, $qty);
     header("location: shopping cart.php");
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
