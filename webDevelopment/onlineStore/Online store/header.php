<?php
require_once "include/classes.inc.php";
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$home = "";
$contact = "";
$login = "";
$signup = "";
$profile = "";
$manageInventory = "";
$order = "";
$cart= "";
$products = "";
$current = $_SESSION['nav'];

 if ($current == "home")
 {
   $home = "current";
 }
 elseif ($current == "products")
 {
   $products= "current";
 }
 elseif ($current == "contact")
 {
   $contact = "current";
 }
 elseif ($current == "cart")
 {
   $cart = "current";
 }
 elseif ($current == "login")
 {
   $login = "current";
 }
 elseif ($current == "signup")
 {
   $signup = "current";
 }
 elseif ($current == "profile")
 {
   $profile = "current";
 }
 elseif ($current == "manage")
 {
   $manageInventory = "current";
 }
 elseif ($current == "order")
 {
   $order = "current";
 }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Nicholas Scrivanich">
    <title>Sparkling Jewelry</title>
    <link rel="stylesheet" href="./CSS/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <header>
      <div class="head-container">
        <div id="branding">
          <img src="Images/logo6.png" alt="logo">
        </div>
        <nav>
          <ul>
            <?php
          if(isset($_SESSION['user']))
          {
            $user = $user = unserialize($_SESSION['user']);
            if(!($user->isAdmin()))
            {
              ?>
              <li class= '<?php echo $home; ?>'><a href='home.php'>Home</a></li>
              <li class = '<?php echo $products; ?>'><a href='productPage.php'>Products</a></li>
              <li class = '<?php echo $cart; ?>'><a href='shopping cart.php'>Shopping Cart</a></li>
              <li class = '<?php echo $profile; ?>'><a href='Profile.php'>Profile</a></li>
              <li class = '<?php echo $order; ?>'><a href='orderHistory.php'>View Order History</a></li>
              <li><a href="include/logOut.inc.php?LogOut" onclick="return confirm('Are you sure to logout?')">Logout</a></li>
              <li class = '<?php echo $contact; ?>'><a href='contact.php'>Contact</a></li>
            <?php  }
            else
            {?>
              <li class= '<?php echo $home; ?>'><a href='home.php'>Home</a></li>
              <li class = '<?php echo $products; ?>'><a href='productPage.php'>Products</a></li>
              <li><a href="include/logOut.inc.php?LogOut" onclick="return confirm('Are you sure to logout?')">Logout</a></li>
              <li class = '<?php echo $manageInventory; ?>'><a href='manageInventory.php'>Manage Inventory</a></li>
      <?php }
          }
          else
          {?>
            <li class= '<?php echo $home; ?>'><a href='home.php'>Home</a></li>
            <li class = '<?php echo $products; ?>'><a href='productPage.php'>Products</a></li>
            <li class = '<?php echo $login; ?>'><a href='login.php'>Log in</a></li>
            <li class = '<?php echo $signup; ?>'><a href='signup.php'>Sign Up</a></li>
            <li class = '<?php echo $contact; ?>'><a href='contact.php'>Contact</a></li>
    <?php } ?>
          </ul>
        </nav>
      </div>
    </header>
