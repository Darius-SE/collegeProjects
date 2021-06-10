<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "contact";
require "header.php";
require "./include/contactValidation.inc.php";


if(isset($_SESSION['user']))
{
  $user = unserialize($_SESSION['user']);
  if($user->isAdmin())
  {
    header("Location: home.php");
  }
}
?>
<div class="container">
  <div class="main">


    <div class="SignUp-form">
    <form class="" action="contact.php" method="post">
      <h1>Contact Us!</h1>

      <div class="error-sign"> <?php echo $nameError; ?></div>
      <?php
    if(empty($nameError))
    {
    echo "<input type='text' name='name' placeholder='Name'  value=\"" . $name . "\">";
    }
    else
    {
    echo "<input class = 'error-input' type='text' name='name' placeholder='Name' value=\"" . $name . "\">";
    }
    ?>

  <div class="error-sign"> <?php echo $emailError; ?></div>
  <?php
  if (empty($emailError))
  {
  echo "<input type='text' name='email' placeholder='Email' value=\"" . $email . "\">";
  }
  else
  {
  echo "<input class = 'error-input' type='text' name='email' placeholder='Email'  value=\"" . $email . "\">";
  }
  ?>
  <div class="error-sign"> <?php echo $msgError; //make this a message error ?></div>
  <div class = "msg">

  <?php

    if(empty($msgError)) //create a message error wherever nick made his name error
    {
     echo "<textarea  class = 'desc' name='message' rows='1' cols='50' wrap='physical' placeholder='Message'>" . "$message" ."</textarea>";
    }
    else
    {
    echo "<textarea  class = 'desc-error' name='message' rows='1' cols='50' wrap='physical' placeholder='Message'>" . "$message" ."</textarea>";
    }

    ?>

  </div>

  <?php
      //this button below may need to act a little differenet than sign up. grab data base compare and replace.
      // not adding to the data base.
      // like the password lab comparing?
  ?>

      <input type="submit" name="submit-Signup" value="send message" class="signUp-butn">


      </form>


      </div>












</div>
</div>
<?php require "footer.php" ?>
</body>

</html>
