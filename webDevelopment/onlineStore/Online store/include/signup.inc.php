<?php
require_once "include/classes.inc.php";

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(isset($_SESSION['user']))
{
    header("Location: home.php");
}

$username = "";//
$password = "";
$passwordRepeat = "";
$name = "";//
$email = "";//
$phone = "";
$address = "";
$usernameError = "";
$passwordError = "";
$passwordErrorRepeat = "";
$nameError = "";
$emailError = "";
$phoneError = "";
$addressError = "";
$error = false;

if (isset($_POST['submit-Signup']))
{
  $username = sanitize($_POST['username']);

  $password = sanitize($_POST['password']);
  $passwordRepeat = sanitize($_POST['passwordRepeat']);

  $name = sanitize($_POST['name']);
  $name = preg_replace('/\s+/',' ', $name);

  $email = sanitize($_POST['email']);

  $phone = sanitize($_POST['phone']);

  $address = sanitize($_POST['address']);
  $address = preg_replace('/\s+/',' ', $address);

  if(empty($username))
  {
      $usernameError = "Username field must be filled out";
      $error = true;
  }
  elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', $username))
  {
    $usernameError = "Username must only consist of numbers and letters";
    $error = true;
  }
  elseif (strlen($username) < 4)
  {
    $usernameError = "Username must contain at least 4 or more characters";
    $error = true;
  }

  if(empty($email))
  {
      $emailError = "Email field must be filled out";
      $error = true;
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    $emailError = "Invalid email format";
    $error = true;
  }

  if(empty($name))
  {
      $nameError = "Name field must be filled out";
      $error = true;
  }
  elseif (!preg_match('/^[a-zA-Z ]+$/', $name))
  {
    $nameError = "Name field can only consist of letters";
    $error = true;
  }

  if(empty($phone))
  {
      $phoneError = "Phone field must be filled out";
      $error = true;
  }
  elseif (!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone))
  {
    $phoneError = "Invalid format";
    $error = true;
  }

  $number    = preg_match('@[0-9]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);
  if(empty($password))
  {
      $passwordError = "Password field must be filled out";
      $error = true;
  }
  elseif (strlen($password) < 6)
  {
    $passwordError = "Password must be 6 or more characters long";
    $error = true;
  }
  elseif (!$number || !$specialChars)
  {
    $passwordError = "Password must contain 1 special character and 1 number";
    $error = true;
  }

  if(empty($passwordRepeat))
  {
    $passwordErrorRepeat = "Password must be re-entered";
    $error = true;
  }
  elseif (($passwordRepeat != $password) and !empty($password))
  {
    $passwordErrorRepeat = "Passwords must match";
    $error = true;
  }

  if(empty($address))
  {
      $addressError = "address field must be filled out";
      $error = true;
  }



  if(!$error)
  {

    $user = new Customer($username,  $password, $email, $name, $address, $phone);
    if($user->signup($usernameError, $emailError))
    {
      if (session_status() == PHP_SESSION_NONE)
      {
          session_start();
      }
      $_SESSION['user'] = serialize($user);

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
