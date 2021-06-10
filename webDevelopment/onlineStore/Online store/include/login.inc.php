<?php
require_once "classes.inc.php";
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(isset($_SESSION['user']))
{
    header("Location: home.php");
}




$user = "";
$password = "";
$userError = "";
$passwordError = "";
$error = false;

if (isset($_POST['submit-Login']))
{

  $user = sanitize($_POST['user']);
  $password = sanitize($_POST['password-login']);

  if (empty($user))
  {
    $userError = "Username or email must be entered";
    $error = true;
  }

  if (empty($password))
  {
    $passwordError = "A password must be entered";
    $error = true;
  }

  if(!$error)
  {

    $storeUser = new Customer($user, $password);
    if($storeUser->login($userError))
    {
      if($storeUser->isAdmin())
      {
        $storeUser = new Admin($user, $password);
        $storeUser->login($userError);
      }

      if (session_status() == PHP_SESSION_NONE)
      {
          session_start();
      }
      $_SESSION['user'] = serialize($storeUser);
      header("Location: home.php");
    }
    else
    {
      unset($storeUser);
    }
    /*$query = "SELECT * FROM users WHERE username = ? or email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query))
    {
      echo "SQL error 1";
      exit();
    }
    else
    {
      mysqli_stmt_bind_param($stmt, "ss", $user, $user);
      mysqli_stmt_execute($stmt);
      $resultUser =  mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($resultUser))
      {
        $checkPassword = password_verify($password, $row['password']);
        if (!$checkPassword)
        {
          $userError = "Username or password is incorrect";
          $passwordError = " ";
        }
        else
        {
          if (session_status() == PHP_SESSION_NONE)
          {
              session_start();
          }

          $_SESSION['userId'] = $row['userId'];
          $_SESSION['isAdmin'] = $row['isAdmin'];
          $_SESSION['name'] = $row['name'];

          header("Location: home.php");
        }

      }
      else
      {
        $userError = "Username or password is incorrect";
        $passwordError = " ";
      }
    }*/
  }


}


function sanitize($var)
{
  $var = stripslashes($var);
  $var = strip_tags($var);
  $var = htmlentities($var);
  return $var;

}
