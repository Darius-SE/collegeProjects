<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "profile";
require "header.php";


if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
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
?>

<div class="container">
  <div class="main">
<div class="profile">

  <h2> Personal Information</h2>

<p class="col1">Name: <?php echo $user->getName() ?> </p>

<p class="col1">Username: <?php echo $user->getUsername() ?> </p>

<p class="col1">Email: <?php echo $user->getEmail() ?> </p>

<p class="col1">Address: <?php echo $user->getAddress() ?> </p>

<p class="col1">Phone: <?php echo $user->getPhone() ?> </p>


  <input type="submit" name="submit-Signup" value="Edit Profile" onclick="edit()" class="signUp-butn">

</div>

<script>

edit = function ()
{
  window.location.href='profileForm.php';
}

</script>


</div>
</div>

<?php require "footer.php" ?>
</body>

</html>
