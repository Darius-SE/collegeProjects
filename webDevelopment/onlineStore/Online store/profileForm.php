<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "profile";
require "header.php";
require_once "include/classes.inc.php";


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
require "./include/profileForm.inc.php";
?>

<div class="container">
  <div class="main">



    <div class="SignUp-form">
    <form class="" action="profileForm.php" method="post">
      <h1>Profile Information</h1>

  <div class="error-sign"> <?php echo $nameError; ?></div>

     <?php
    if(empty($nameError))
    {
    echo "<input type='text' name='name' placeholder='Name'  value=\"" . $name . "\">";
  //this value needs to be one from the database not so much a place holder.
    }
    else
    {
    echo "<input class = 'error-input' type='text' name='name' placeholder='Name' value=\"" . $name . "\">";
  //this value can either revert to nothing until they type it right or revert to previous value
    }
    ?>

    <div class="error-sign"> <?php echo $usernameError; ?></div>

       <?php
      if(empty($usernameError))
      {
      echo "<input type='text' name='username' placeholder='Username'  value=\"" . $username . "\">";
    //this value needs to be one from the database not so much a place holder.
      }
      else
      {
      echo "<input class = 'error-input' type='text' name='username' placeholder='Username' value=\"" . $username . "\">";
    //this value can either revert to nothing until they type it right or revert to previous value
      }
      ?>

  <div class="error-sign"> <?php echo $emailError; ?></div>
  <?php
  if (empty($emailError))
  {
  echo "<input type='text' name='email' placeholder='Email' value=\"" . $email . "\">";
  //this value needs to be one from the database not so much a place holder.
  }
  else
  {
  echo "<input class = 'error-input' type='text' name='email' placeholder='Email'  value=\"" . $email . "\">";
  //this value can either revert to nothing until they type it right or revert to previous value
  }
  ?>


  <div class="error-sign"> <?php echo $addressError; ?></div>
  <?php
  if (empty($addressError))
  {
  echo "<input type='text' name='address' placeholder='Address' value=\"" . $address . "\">";
        //this value needs to be one from the database not so much a place holder.
  }
  else
  {
  echo "<input class = 'error-input' type='text' name='address' placeholder='Address'  value=\"" . $address . "\">";
        //this value can either revert to nothing until they type it right or revert to previous value
  }
  ?>

    <div class="error-sign"> <?php echo $phoneError; ?></div>
    <?php

    if (empty($phoneError))
    {
    echo "<input type='text' name='phone' placeholder='Phone Number: XXX-XXX-XXXX' value=\"" . $phone . "\">";
  //this value needs to be one from the database not so much a place holder.
    }
    else
    {
    echo "<input class = 'error-input' type='text' name='phone' placeholder='Phone Number: XXX-XXX-XXXX'  value=\"" . $phone . "\">";
    //this value can either revert to nothing until they type it right or revert to previous value
  }
    ?>

  <?php
      //this button below may need to act a little differenet than sign up. grab data base compare and replace.
      // not adding to the data base.
      // like the password lab comparing?
  ?>

      <input type="submit" name="submit-Signup" value="Save" class="signUp-butn">

      </form>

  </div>















</div>
</div>
<?php require "footer.php" ?>
</body>

</html>
