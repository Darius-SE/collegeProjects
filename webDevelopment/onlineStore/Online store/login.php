<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "login";
require_once "header.php";
require "./include/login.inc.php";
if(isset($_SESSION['user']))
{
    header("Location: home.php");
}
?>
  <body>
<div class="container">
  <div class="main">

  </div>
    <div class="Login-form">
    <form class="" action="login.php" method="post">
      <h1 >Login</h1>

      <div class="error-login"> <?php echo $userError; ?></div>
      <?php
    if(empty($userError))
    {
    echo "<input type='text' name='user' placeholder='Username or Email'  value=\""  . $user . "\">";
   }
    else
    {
    echo "<input class = 'error-input' type='text' name='user' placeholder='Username or Email' value=\"" . $user . "\">";
  }
    ?>

  <div class="error-login"> <?php echo $passwordError; ?></div>
  <?php
  if (empty($passwordError))
  {
  echo "<input type='password' name= 'password-login' placeholder='Password'>";
  }
  else
  {
  echo "<input class = 'error-input' type='password' name='password-login' placeholder='Password'>";
}
  ?>

      <input type="submit" name="submit-Login" value="Log in" class="signUp-butn">

      </form>
      
          <a href="signup.php">Create an account</a>
      </div>

  </div>
    </div>
  <?php require "footer.php" ?>
  </body>

  </html>
