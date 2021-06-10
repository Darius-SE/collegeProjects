<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "manage";
require "header.php";

if(!isset($_SESSION['user']))
{
  header("Location: home.php");
}
else
{
  $user = unserialize($_SESSION['user']);
  if(!($user->isAdmin()))
  {
    header("Location: home.php");
  }
}
 ?>
 <div class="container">
 <div class="main">


   <div class = "manage-container">
     <div class="manage-box">
       <img  src="https://www.freeiconspng.com/uploads/add-list-icon--icon-search-engine-26.png"  alt="Icon Svg Add" />
       <a href="addProductForm.php">
       <div class="manage-overlay">
           <h1>Add Product</h1>
       </div>
       </a>
        </div>
        <div class = "manage-box">
      <img  src="Images/remove.png"  alt="Remove, storage icon" />
      <a href="removeProductForm.php">
      <div class="manage-overlay">
        <h1>Remove Product</h1>
      </div>
      </a>
        </div>
      <div class = "manage-box">
  <img src="https://www.freeiconspng.com/uploads/edit-icon-16.png"   alt="Edit Free Icon" />
  <a href="editProductForm.php">
  <div class="manage-overlay">
      <h1>Edit Product</h1>
  </div>
</a>
    </div>


</div>

 </div>
 </div>
 <?php require "footer.php" ?>
 </body>
 </html>
