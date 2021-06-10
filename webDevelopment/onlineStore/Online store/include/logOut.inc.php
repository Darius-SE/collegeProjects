<?php
require "classes.inc.php";
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if(isset($_GET['LogOut']) and isset($_SESSION['user']))
{
  $user = unserialize($_SESSION['user']);
  $user->logOut();
  unset($user);
  header("Location: ../home.php");
}
else
{
 header("Location: ../home.php");
}
 ?>
