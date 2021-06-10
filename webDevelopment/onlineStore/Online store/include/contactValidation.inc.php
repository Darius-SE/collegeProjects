<?php

require "include/login-Database.inc.php";

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(isset($_SESSION['userId']))
{
    header("Location: home.php");
}


$name = "";//
$message = ""; // added variable for message
$email = "";//
$nameError = "";
$msgError = ""; // added variable for message error
$emailError = "";
$error = false;

if (isset($_POST['submit-Signup']))
{


  $name = sanitize($_POST['name']);
  $name = preg_replace('/\s+/',' ', $name);
  // message check and sanitize starts here
  $message = sanitize($_POST['message']);
 $message = preg_replace('/\s+/',' ', $message);
//message check and sanitize ends
  $email = sanitize($_POST['email']);



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
  // message input check start
  if(empty($message))
  {
      $msgError = "Message field must be filled out";
      $error = true;
  }



  if(!$error)
  {

    $mailTo = "srbarton17@gmail.com";
  	$headers = "From: ".$email;
  	$txt = "you have received an email from ".$name . ".\n\n" .$message;
  	mail($mailTo,$name, $txt, $headers);
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
