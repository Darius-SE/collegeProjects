<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "manage";
require "header.php";
require_once "include/classes.inc.php";

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

$error = "";


if(isset($_POST['ID']))
{
  $inv = new Inventory();
  $id = $_POST['ID'];

  $id = sanitize($id);


  if(empty($id))
  {
    $error = "A product ID must be entered.";
  }
  elseif (!preg_match('/^[0-9]+$/', $id))
  {
    $error = "Only integers must be entered";
  }
  else
  {
      if($inv->SearchInventory($id) != null)
      {
        $product = $inv->SearchInventory($id);
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        $_SESSION['product'] = serialize($product);
        header("Location: editProduct.php");
      }
      else
      {
        $error = "No product Id was found";
      }

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

 ?>


 <div class="container">
   <div class="main">

 <div class="search-form">


   <h1>Search</h1>

   <form method="post" action="editProductForm.php">
   <?php if($error == "")
   {?>
   <input type="text" class = "search-admin" name = "ID" placeholder="Search for Product by ID">
 <?php } else { ?>
   <span class = "search-error">
   <?php echo $error; ?>
   </span>
   <br>
   <input class = "search-input-error" type="text" name = "ID" placeholder="Search for Transaction ID">
 <?php } ?>
   <br>
  <input type="submit"  name = 'search' value="Search" class="search-button">
  <input type="button" value="Go Back" onclick="location.href = 'manageInventory.php';" class="search-button">

       </form>
     </div>

   </div>
   </div>
   <?php require "footer.php" ?>
   </body>

   </html>
