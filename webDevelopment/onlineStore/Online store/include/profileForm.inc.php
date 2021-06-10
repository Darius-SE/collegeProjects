<?php

$name = "";//
$email = "";//
$username ="";//
$phone = "";
$address = "";
$nameError = "";
$emailError = "";
$phoneError = "";
$addressError = "";
$usernameError = "";
$error = false;

if (!isset($_POST['submit-Signup']))
{

$name = $user->getName();//
$email = $user->getEmail();//
$username = $user->getUsername();//
$phone = $user->getPhone();
$address = $user->getAddress();

}


if (isset($_POST['submit-Signup']))
{


  $name = sanitize($_POST['name']);
  $name = preg_replace('/\s+/',' ', $name);

  $username = sanitize($_POST['username']);

  $email = sanitize($_POST['email']);

  $phone = sanitize($_POST['phone']);

  $address = sanitize($_POST['address']);
  $address = preg_replace('/\s+/',' ', $address);


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

  if(empty($address))
  {
      $addressError = "address field must be filled out";
      $error = true;
  }



  if(!$error)
  {

    $user->updateProfile($name, $username, $email, $address, $phone);
    header("Location: Profile.php");
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
