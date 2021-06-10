<?php
require_once "include/classes.inc.php";

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

/*if(!isset($_SESSION['user']))
{
    header("Location: home.php");
}
else
{*/
/*  $user = unserialize($_SESSION['user']);
  if(!($user->isAdmin()))
  {
    header("Location: home.php");
  }
}*/
$inv = new Inventory();
$name = "";//
$id = "";
$price = "";
$description = "";//
$quantity = "";//
$pic = "";
$idError = "";
$priceError = "";
$nameError = "";
$descError = "";
$quantityError = "";
$picError = "";
$error = false;



if (isset($_POST['submit-edit']))
{
  $id = sanitize($_POST['id']);

  $price = sanitize($_POST['price']);


  $name = sanitize($_POST['name']);
  $name = preg_replace('/\s+/',' ', $name);

  $description = sanitize($_POST['desc']);


  $quantity = sanitize($_POST['quantity']);



  if(empty($name))
  {
      $nameError = "Product name field must be filled out";
      $error = true;
  }
  elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', $name))
  {
    $nameError = "Product name must only consist of numbers and letters";
    $error = true;
  }


  /*if(empty($id))
  {
      $idError = "Product ID field must be filled out";
      $error = true;
  }
  elseif (!preg_match('/^[0-9]+$/', $id))
  {
    $idError = "Product ID must only contain numbers";
    $error = true;
  }
  elseif ($inv->SearchInventory($id) != NULL)
  {

      $idError = "Product ID already taken and must be changed";
      $error = true;


  }*/

  if(empty($price))
  {
      $priceError = "Price field must be filled out";
      $error = true;
  }
  elseif (!filter_var($price, FILTER_VALIDATE_FLOAT))
  {
    $priceError = "Price must be a floating point number";
    $error = true;
  }
  elseif ($price < 0.0)
  {
    $priceError = "Price must positive";
    $error = true;
  }

  if(empty($description))
  {
      $descError = "Descrtiption field must not be empty";
      $error = true;
  }

  if(empty($quantity))
  {
      $quantityError = "A quantity must be specified";
      $error = true;
  }
  elseif (!filter_var($quantity, FILTER_VALIDATE_INT))
  {
    $quantityError = "Quantity must be an integer";
    $error = true;
  }
  elseif ($quantity < 0)
  {
    $quantityError = "Quantity cannot be negative";
    $error = true;
  }

  if(isset($_FILES['pic']))
  {
    $fileErrors = array(0 => "Success", 1 => "Max file size exceeded", 2 => "Max file size exceeded", 3 => "The file was only partially uploaded", 4 => "No file was uploaded", 5 => "Missing a temporary folder", 6 => "Failed to write file to disk", 7 => "A PHP extension stopped the file load");
    $extensions = array('jpg', 'png', 'jpeg', 'gif');
    $file_ext = explode('.', $_FILES['pic']['name']);
    $file_ext = end($file_ext);


    if(!in_array($file_ext, $extensions))
    {
      $picError = "Invalid extension";
      $error = true;
    }

    //no error
    if($_FILES['pic']['error'])
    {
      $picError = $fileErrors[$_FILES['pic']['error']];
      $error = true;

    }


  }
  else
  {
    $picError = "No picture was submitted";
    $error = true;
  }




  if(!$error)
  {
    move_uploaded_file($_FILES['pic']['tmp_name'], 'Images/' . $_FILES['pic']['name']);
    $inv->editProduct(new Product($id, $name, $price, $description,"Images/" . $_FILES['pic']['name'], $quantity));
    header("Location: manageInventory.php");


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

function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
