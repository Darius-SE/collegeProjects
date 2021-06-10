<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "signup";
require "header.php";
require "./include/signup.inc.php";
if(isset($_SESSION['user']))
{
    header("Location: home.php");
}
?>

<div class="container">
  <div class="main">



    <div class="SignUp-form">
    <form class="" action="signup.php" method="post">
      <h1 >Sign up for an account</h1>

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

  <div class= "error-sign"> <?php echo $emailError; ?></div>
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

  <div class="error-sign"> <?php echo $usernameError; ?></div>
  <?php
  if (empty($usernameError))
  {
  echo "<input type='text' name='username' placeholder='Username' value=\"" . $username . "\">";
  }
  else
  {
  echo "<input class = 'error-input' type='text' name='username' placeholder='Username'  value=\"" . $username . "\">";
  }

  ?>
  <div class="error-sign"> <?php echo $addressError; ?></div>
  <?php
  if (empty($addressError))
  {
  echo "<input type='text' name='address' placeholder='Address' value=\"" . $address . "\">";
  }
  else
  {
  echo "<input class = 'error-input' type='text' name='address' placeholder='Address'  value=\"" . $address . "\">";
  }
  ?>

    <div class="error-sign"> <?php echo $phoneError; ?></div>
    <?php
    if (empty($phoneError))
    {
    echo "<input type='text' name='phone' placeholder='Phone Number: XXX-XXX-XXXX' value=\"" . $phone . "\">";
    }
    else
    {
    echo "<input class = 'error-input' type='text' name='phone' placeholder='Phone Number: XXX-XXX-XXXX'  value=\"" . $phone . "\">";
    }
    ?>

    <div class="error-sign"> <?php echo $passwordError; ?></div>
    <?php
    if (empty($passwordError))
    {
    echo "<input type='password' name='password' placeholder='Password'>";
    }
    else
    {
    echo "<input class = 'error-input' type='password' name='password' placeholder='Password'>";
    }
    ?>

    <div class="error-sign"> <?php echo $passwordErrorRepeat; ?></div>
    <?php
    if (empty($passwordErrorRepeat))
    {
    echo "<input type='password' name='passwordRepeat' placeholder='Re-enter Password'>";
    }
    else
    {
    echo "<input class = 'error-input' type='password' name='passwordRepeat' placeholder='Re-enter Password'>";
    }
    ?>
      <input type="submit" name="submit-Signup" value="Sign Up" class="signUp-butn">

      </form>
        <a href="login.php">Already have an accout?</a>
      </div>

  </div>
    </div>
    <?php require "footer.php" ?>
  </body>

  </html>
