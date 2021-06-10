<?php



class User
{
  protected $name;
  protected $ID;
  protected $password;
  protected $username;
  protected $email;
  protected $isAdmin;

  protected function __construct($username, $password, $email, $name, $isAdmin, $ID = '')
  {
    $this->name = $name;
    $this->ID = $ID;
    $this->password = $password;
    $this->username = $username;
    $this->email = $email;
    $this->isAdmin = $isAdmin;
  }

  public function login(&$usernameError)
  {

    if($userInfo = $this->validateCredentials($usernameError))
    {
      $this->ID = $userInfo['userId'];
      $this->isAdmin = $userInfo['isAdmin'];
      $this->name = $userInfo['name'];
      $this->username = $userInfo['username'];
      $this->email = $userInfo['email'];
      $this->password = $userInfo['password'];
      $this->completeLogin($userInfo['address'], $userInfo['phone']);
      return true;
    }
    else
    {
      return false;
    }

  }

  private function completeLogin($address, $phone)
  {
    if (method_exists($this, 'init'))
    {
      $this->init($address, $phone);
    }
  }

  private function validateCredentials(&$usernameError)
  {
    require "login-Database.inc.php";
    $query = "SELECT * FROM users WHERE username = ? or email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query))
    {
      echo "SQL error 1";
      exit();
    }
    else
    {
      mysqli_stmt_bind_param($stmt, "ss", $this->username, $this->username);
      mysqli_stmt_execute($stmt);
      $resultUser =  mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($resultUser))
      {
        $checkPassword = password_verify($this->password, $row['password']);
        if (!$checkPassword)
        {
          $usernameError = "Username or password incorrect";
          return null;
        }
        else
        {
          return $row;

        }

      }
      else
      {
        $usernameError = "Username or password is incorrect";
        return null;
      }
    }

  }

  public function logOut()
  {
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    session_unset();
    session_destroy();
  }
//---------------------------------getters------------------------------------------------------
  public function getName()
  {
    require "login-Database.inc.php";
$query = "SELECT name FROM users WHERE userId = '$this->ID'";
if(!($result = mysqli_query($conn, $query)))
{
die('Error: ' . mysqli_error($conn));
}

if($row = mysqli_fetch_assoc($result))
{
$this->name = $row['name'];
}
return $this->name;
  }

  public function getID()
  {
    require "login-Database.inc.php";
$query = "SELECT userId FROM users WHERE userId = '$this->ID'";
if(!($result = mysqli_query($conn, $query)))
{
die('Error: ' . mysqli_error($conn));
}

if($row = mysqli_fetch_assoc($result))
{
$this->ID = $row['userId'];
}
return $this->ID;
  }

  public function getUsername()
  {
    require "login-Database.inc.php";
$query = "SELECT username FROM users WHERE userId = '$this->ID'";
if(!($result = mysqli_query($conn, $query)))
{
die('Error: ' . mysqli_error($conn));
}

if($row = mysqli_fetch_assoc($result))
{
$this->username = $row['username'];
}
return $this->username;
  }

  public function getEmail()
  {
    require "login-Database.inc.php";
$query = "SELECT email FROM users WHERE userId = '$this->ID'";
if(!($result = mysqli_query($conn, $query)))
{
die('Error: ' . mysqli_error($conn));
}

if($row = mysqli_fetch_assoc($result))
{
$this->email = $row['email'];
}
return $this->email;
  }



  public function getPassword()
  {
    return $this->password;
  }

  public function isAdmin()
  {
    return $this->isAdmin;
  }
//-----------------------------------setters-----------------------------------------------------
  public function setName($name)
  {
    $this->name = $name;
  }

  public function setID($id)
  {
    $this->ID = $id;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }




}

class Customer extends User
{
  private $phone;
  private $address;
  private $cart;

  public function __construct($username, $password, $email = '', $name = '', $address = '' , $phone = '')
  {
    parent::__construct($username, $password, $email, $name, false);
    $this->phone = $phone;
    $this->address = $address;
    /*if($this->ID)
    {*/
    $this->cart = new ShoppingCart($this->ID);
  //}

  }

  public function accessOrder($amount, $productList)
  {
    return new Order($this->ID, $amount, $productList);
  }

  public function accessCart()
  {

    return $this->cart;
  }


  public function signUp(&$usernameError, &$emailError)
  {
    require "login-Database.inc.php";
    $query1 = "SELECT username FROM users WHERE username = ?";
    $stmt1 = mysqli_stmt_init($conn);

    $query2 = "SELECT username FROM users WHERE email = ?";
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $query1) || !mysqli_stmt_prepare($stmt2, $query2))
    {
      $usernameError = "SQL error";
      return false;
    }
    else
    {

      mysqli_stmt_bind_param($stmt1, "s", $this->username);
      mysqli_stmt_execute($stmt1);
      mysqli_stmt_store_result($stmt1);

      mysqli_stmt_bind_param($stmt2, "s", $this->email);
      mysqli_stmt_execute($stmt2);
      mysqli_stmt_store_result($stmt2);

      $resultUsername = mysqli_stmt_num_rows($stmt1);
      $resultEmail = mysqli_stmt_num_rows($stmt2);
      if($resultUsername > 0 or $resultEmail > 0)
      {
          if ($resultUsername > 0)
          {
              $usernameError = "Username is already taken";

          }
          if ($resultEmail > 0)
          {
              $emailError = "Email is already in use";

          }
          return false;
      }
      else
      {
        //Generate customerId
        $isTaken = true;
        while ($isTaken)
        {
          $customerId = rand(1000,9999);
          $query4 = "SELECT customerId FROM users WHERE customerId = '$customerId'";
          if(!($result = mysqli_query($conn, $query4)))
          {
            die('Error: ' . mysqli_error($conn));
          }
          if(!($row = mysqli_fetch_assoc($result)))
          {
            $isTaken = false;
            $this->ID = $customerId;
          }


        }


        $query5 = "INSERT INTO customers (customerId, customerPhone, customerAddress) VALUES ('$customerId','$this->phone','$this->address')";
        if(!mysqli_query($conn, $query5))
        {
          die('Error: ' . mysqli_error($conn));
        }
        /*$stmt5 = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt5, $query5);
        $result = mysqli_stmt_bind_param($stmt5, "iss", $customerId, $this->phone, $this->address) or trigger_error(mysql_error());;
        mysqli_stmt_execute($stmt5);*/



        $query3 = "INSERT INTO users (userId, adminId, customerId, username, name, email, password, isAdmin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt3 = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt3, $query3);
        $username = $this->username;
        $name = $this->name;
        $email = $this->email;
        $notAdmin = 0;
        $noAdminId = null;
        $pass = password_hash($this->password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt3, "iiissssi", $customerId, $noAdminId, $customerId ,$username, $name, $email, $pass,  $notAdmin);
        mysqli_stmt_execute($stmt3);
        $this->cart = new ShoppingCart($this->ID);
        return true;
      }
    }

  }

  protected function init($address, $phone)
  {
    $this->address = $address;
    $this->phone = $phone;
    $this->cart = new ShoppingCart($this->ID);
  }

//-------------------------------------getters---------------------------------------------------------------------------------
public function getOrderHistory()
{
  require "login-Database.inc.php";
  $orders = array();
  $orderIds = array();

  $query = "SELECT OrderID FROM orders WHERE customerId = '$this->ID'";//change $this->iD
  if(!($result = mysqli_query($conn, $query)))
  {
    die('Error: ' . mysqli_error($conn));
  }

  while ($row = mysqli_fetch_assoc($result))
  {
    $orderId = $row['OrderID'];
    $query1 = "SELECT * FROM orderproducts WHERE OrderID = '$orderId'";
    if(!($result1 = mysqli_query($conn, $query1)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    while ($row1 = mysqli_fetch_assoc($result1))
    {
      $productId = $row1['productId'];
      $productQuantity = $row1['quantity'];
      $date = $row1['dateOfPurchase'];
      $query2 = "SELECT * FROM products WHERE productId = '$productId'";
      if(!($result2 = mysqli_query($conn, $query2)))
      {
        die('Error: ' . mysqli_error($conn));
      }
      if ($row2 = mysqli_fetch_assoc($result2))
      {
        $product = new Product($productId , $row2['name'], $row2['price'], $row2['description'], $row2['picture'],  $productQuantity);
        $orders[] = $product;
        $orderIds[] = $row['OrderID'];
      }
    }
  }
  $arr = array();
  $arr[] = $orders;
  $arr[] = $orderIds;
  return $arr;
}

  public function getPhone()
  {
          require "login-Database.inc.php";
    $query = "SELECT customerPhone FROM customers WHERE customerId = '$this->ID'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    if($row = mysqli_fetch_assoc($result))
    {
      $this->phone = $row['customerPhone'];
    }
    return $this->phone;
  }

  public function getAddress()
  {
          require "login-Database.inc.php";
    $query = "SELECT customerAddress FROM customers WHERE customerId = '$this->ID'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    if($row = mysqli_fetch_assoc($result))
    {
      $this->address = $row['customerAddress'];
    }
    return $this->address;
  }


//---------------------------------setters-----------------------------------------------------------------------

  public function setPhone($phone)
  {
    $this->phone = $phone;
  }

  public function setAddress()
  {
    $this->address = $address;
  }

  public function updateProfile($name, $username, $email, $address, $phone)
  {
      require "login-Database.inc.php";
    $this->phone = $phone;
    $this->address = $address;
    $this->name = $name;
    $this->email = $email;
    $this->username = $username;

    $query = "UPDATE customers SET customerAddress = '$this->address' ,  customerPhone = '$this->phone' WHERE customerId = '$this->ID'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    $query1 = "UPDATE users SET name = '$this->name' , email = '$this->email', username = '$username'  WHERE customerId = '$this->ID'";
    if(!($result1 = mysqli_query($conn, $query1)))
    {
      die('Error: ' . mysqli_error($conn));
    }


  }


}

class Admin extends User
{
  public function __construct($username, $password, $email = '', $name = '')
  {
    parent::__construct($username, $password, $email, $name, true);
  }

}

class Product
{
  private $productId;
  private $quantity;
  private $name;
  private $description;
  private $picture;
  private $price;

  public function __construct($productId, $name,  $price,
                              $description, $picture, $quantity = 1)
  {
    $this->productId = $productId;
    $this->quantity = $quantity;
    $this->name = $name;
    $this->description = $description;
    $this->picture = $picture;
    $this->price = $price;
  }

  /*public function addComment($comment)
  {
    $this->comments[] = $comment;
  }*/


  public function addRating($rating)
  {
    require "login-Database.inc.php";
    $error = "";
    if($rating < 0.0 or $rating > 5.0)
    {
      $error = "Rating must be in between 0.0 or 5.0";
      return $error;
    }
    else
    {
      $query = "INSERT INTO reviews (productId, rating) VALUES ('$this->productId', '$rating')";
      if(!mysqli_query($conn, $query))
      {
        die('Error: ' . mysqli_error($conn));
      }

      $avgRating = $this->getAverageRating();
      $query = "UPDATE products SET avgRating = '$avgRating' WHERE productId = '$this->productId'";
      if(!($result = mysqli_query($conn, $query)))
      {
        die('Error: ' . mysqli_error($conn));
      }

    }
    return $error;
  }

//--------------------------------------------------------getters----------------------------------------------------------------


  /*public function getComments()
  {
    return $this->comments;
  }
*/
  public function getAverageRating()
  {
    require "login-Database.inc.php";
    $query = "SELECT rating FROM reviews WHERE productId = '$this->productId'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }
    $n = 0;
    $sum = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $sum += $row['rating'];
      $n++;
    }

    if ($n != 0)
    {
      $avg = $sum/$n;
      return number_format((float)$avg, 1, '.', '');
    }
    else
    {
      return $n;
    }
  }

  public function getProductId()
  {
    return $this->productId;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getPicture()
  {
    return $this->picture;
  }

  public function getQuantity()
  {
    return $this->quantity;
  }

  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;
  }

  public function getPrice()
  {
    return $this->price;
  }



}

class ShoppingCart
{
  private $customerId;

  public function __construct($customerId)
  {
    $this->customerId = $customerId;
  }



  public function isEmpty()
  {
    require "login-Database.inc.php";
    $query = "SELECT * FROM cart";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    if ($row = mysqli_fetch_assoc($result))
    {
      return false;
    }
    else
    {
      return true;
    }


  }

  public function addToCart($productId, $qty)
  {

    $error = "";
    require "login-Database.inc.php";
    $query2 = "SELECT * FROM cart WHERE productId = '$productId' AND customerId = '$this->customerId'";
    if(!($result = mysqli_query($conn, $query2)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    if ($row = mysqli_fetch_assoc($result))
    {
      $error = $this->changeQuantity($productId, $qty);
      return $error;
    }
    else
    {
      $query = "INSERT INTO cart (customerId, productId, quantity) VALUES ('$this->customerId', '$productId', '$qty')";
      if(!mysqli_query($conn, $query))
      {
        die('Error: ' . mysqli_error($conn));
      }
    }
  return $error;
  }

  public function removeFromCart($productId)
  {
    require "login-Database.inc.php";
    $error = "";
    if ($this->isEmpty())
    {
      $error = "Shopping cart is empty";
      return $error;
    }
    else
    {
      $query2 = "SELECT * FROM cart WHERE productId = '$productId' AND customerId = '$this->customerId'";
      if(!($result = mysqli_query($conn, $query2)))
      {
        die('Error: ' . mysqli_error($conn));
      }

      if (!($row = mysqli_fetch_assoc($result)))
      {
        $error = "Product is not in shopping cart";
        return $error;
      }
      else
      {
        $query1 = "DELETE FROM cart WHERE productId = '$productId' and customerId = '$this->customerId'";
        if(!mysqli_query($conn, $query1))
        {
          die('Error: ' . mysqli_error($conn));
        }
      }
    }
    return $error;
  }

  public function changeQuantity($productId, $quantity)
  {
    require "login-Database.inc.php";
    $error = "good";
    if ($this->isEmpty())
    {
      $error = "Shopping cart is empty";
      return $error;
    }
    elseif ($quantity <= 0)
    {
      $error = "Quantity cannot be less than 1";
      return $error;
    }
    else
    {
      $query = "SELECT * FROM cart WHERE productId = '$productId' AND customerId = '$this->customerId'";
      if(!($result = mysqli_query($conn, $query)))
      {
        die('Error: ' . mysqli_error($conn));
      }

      if (!($row = mysqli_fetch_assoc($result)))
      {
          $error = "Product is not in shopping cart";
          return $error;
      }
      else
      {
        $query3 = "SELECT * FROM products WHERE productId = '$productId'";
        if(!($result = mysqli_query($conn, $query3)))
        {
          die('Error: ' . mysqli_error($conn));
        }

        if (!($row = mysqli_fetch_assoc($result)))
        {
          $error = "Product not available";

          return $error;
        }
        else
        {
          if($row['quantity'] < $quantity)
          {
            $error = "Not enough products available in inventory";
            return $error;
          }
        }

        $query1 = "UPDATE cart SET quantity = '$quantity' WHERE productId = '$productId'";
        if(!($result = mysqli_query($conn, $query1)))
        {
          die('Error: ' . mysqli_error($conn));
        }

      }

    }
    return $error;
  }

  public function getCartItems()
  {
    require "login-Database.inc.php";
    $arr = array();
    $query = "SELECT *, cart.quantity AS cQuantity FROM cart INNER JOIN products
    ON cart.productId = products.productId Where cart.customerId = '$this->customerId'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    while (($row = mysqli_fetch_assoc($result)))
    {
      $arr[] = new Product($row['productId'], $row['name'], $row['price'], $row['description'], $row['picture'], $row['cQuantity']);
    }
    return $arr;

  }

  public function getAmount()
  {
    require "login-Database.inc.php";
    $amount = 0.0;
    if ($this->isEmpty())
    {
      return $amount;
    }
    else
    {
      $query = "SELECT *, cart.quantity AS cQuantity FROM cart INNER JOIN products
      ON cart.productId = products.productId Where cart.customerId = '$this->customerId'";
      if(!($result = mysqli_query($conn, $query)))
      {
        die('Error: ' . mysqli_error($conn));
      }

      while (($row = mysqli_fetch_assoc($result)))
      {
        $amount += $row['price'] * $row['cQuantity'];
      }

    }
    return $amount;
  }

  public function clearCart()
  {
    require "login-Database.inc.php";
    $query = "DELETE FROM cart WHERE customerId = '$this->customerId'";
    if(!mysqli_query($conn, $query))
    {
      die('Error: ' . mysqli_error($conn));
    }

  }


}

class Inventory
{
  public function __construct(){}

  public function addProduct(Product $product)
  {
      require "login-Database.inc.php";
    $error = "";
    $id = $product->getProductId();
    echo $id;

    $query2 = "SELECT * FROM products WHERE productId = '$id'";
    if(!($result = mysqli_query($conn, $query2)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    if ($row = mysqli_fetch_assoc($result))
    {
      $error = "Product is already in inventory";
      return $error;
    }
    else
    {
      $price = $product->getPrice();
      $name = $product->getName();
      $desc = $product->getDescription();
      $quant = $product->getQuantity();
      $pic = $product->getPicture();

      $query = "INSERT INTO products (productId, price, name, description, quantity, picture) VALUES ('$id','$price' ,'$name', '$desc', '$quant', '$pic')";
      if(!mysqli_query($conn, $query))
      {
        die('Error: ' . mysqli_error($conn));
      }

    }

    return $error;
  }

  public function removeProduct($productId)
  {
    require "login-Database.inc.php";
    $error = "";
    $query2 = "SELECT * FROM products WHERE productId = '$productId'";
    if(!($result = mysqli_query($conn, $query2)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    if (!($row = mysqli_fetch_assoc($result)))
    {
      $error = "No product exists";
      return $error;
    }
    else
    {
      $query = "DELETE FROM products WHERE productId = '$productId'";
      if(!mysqli_query($conn, $query))
      {
        die('Error: ' . mysqli_error($conn));
      }
    }
    return $error;
  }

  public function editProduct(Product $product)
  {
  require "login-Database.inc.php";
      $price = $product->getPrice();
      $name = $product->getName();
      $desc = $product->getDescription();
      $quant = $product->getQuantity();
      $pic = $product->getPicture();
      $productId = $product->getProductId();

      $query3 = "UPDATE products SET quantity = '$quant', productId = '$productId', price = '$price', name = '$name', description = '$desc', picture = '$pic' WHERE productId = '$productId'";
      if(!($result = mysqli_query($conn, $query3)))
      {
        die('Error: ' . mysqli_error($conn));
      }

  }
  public function filter($query)
  {
    require "login-Database.inc.php";

    $arr = array();

    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result))
    {
      $arr[] = new Product($row['productId'] , $row['name'], $row['price'], $row['description'], $row['picture'], $row['quantity']);
    }

    return $arr;

  }

  public function updateInventory($productId, $quantity)
  {
    require "login-Database.inc.php";
    $error = "";

    if ($quantity <= 0)
    {
      $error = "Quantity cannot be less than 1";
      return $error;
    }

    $query2 = "SELECT * FROM products WHERE productId = '$productId'";
    if(!($result = mysqli_query($conn, $query2)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    if (!($row = mysqli_fetch_assoc($result)))
    {
      $error = "No product exists";
      return $error;
    }
    else
    {
      $query3 = "UPDATE products SET quantity = '$quantity' WHERE productId = '$productId'";
      if(!($result = mysqli_query($conn, $query3)))
      {
        die('Error: ' . mysqli_error($conn));
      }

    }
    return $error;
  }

  public function getInventoryQuantity($productId)
  {
    require "login-Database.inc.php";
    $query = "SELECT * FROM products WHERE productId = '$productId'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }
    if ($row = mysqli_fetch_assoc($result))
    {
      return $row['quantity'];
    }
    else
    {
      return 0;
    }

  }

  public function SearchInventory($productId)
  {
    require "login-Database.inc.php";
    $query = "SELECT * FROM products WHERE productId = '$productId'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }
    if ($row = mysqli_fetch_assoc($result))
    {
      $product = new Product($productId , $row['name'], $row['price'], $row['description'], $row['picture'], $row['quantity']);
      return $product;
    }
    else
    {
      return null;
    }

  }

  public function SearchInventoryByName($productName)
  {
    require "login-Database.inc.php";
    $arr = array();
    $query = "SELECT * FROM products WHERE name LIKE '$productName'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($result))
    {
      $arr[] = new Product($row['productId'] , $row['name'], $row['price'], $row['description'], $row['picture'], $row['quantity']);

    }


      return $arr;
  }
}

class Order
{
  private $subTotal;
  private $total;
  private  $tax;
  private $ID;
  private $FED_TAX = 0.07;
  private $customerId;

  public function __construct($customerId, $amount = 0)
  {
    require "login-Database.inc.php";
    $this->subTotal = $amount;
    $this->tax = $this->subTotal * $this->FED_TAX;
    $this->total = $this->subTotal + $this->tax;
    $this->customerId = $customerId;
    //Generate orderId
    $isTaken = true;
    while ($isTaken)
    {
      $orderId = rand(10000,99999);
      $query = "SELECT orderID FROM orders WHERE OrderID = '$orderId'";
      if(!($result = mysqli_query($conn, $query)))
      {
        die('Error: ' . mysqli_error($conn));
      }

      if(!($row = mysqli_fetch_assoc($result)))
      {
        $isTaken = false;
        $this->ID = $orderId;
      }
    }
  }




  public function placeOrder($productList)
  {
    require "login-Database.inc.php";
    echo $this->ID;
    echo $this->customerId;

    $query = "INSERT INTO orders (OrderID, customerId) VALUES ('$this->ID', '$this->customerId')";
    if(!mysqli_query($conn, $query))
    {
      die('Error: ' . mysqli_error($conn));
    }


    foreach ($productList as $item)
    {
      $itemId = $item->getproductId();
      $itemQuantity = $item->getQuantity();
      $date = date("m/d/Y");
      $query = "INSERT INTO orderproducts (OrderID, productId, quantity, dateOfPurchase) VALUES ('$this->ID', '$itemId', '$itemQuantity' , '$date')";
      if(!mysqli_query($conn, $query))
      {
        die('Error: ' . mysqli_error($conn));
      }
    }







    //reduce inventory quantity
    $error = "No matching order was found";
    $query = "SELECT * FROM orderproducts WHERE OrderID = '$this->ID'";
    if(!($result = mysqli_query($conn, $query)))
    {
      die('Error: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result))
    {
      $error = "";
      $productId = $row['productId'];
      $quantity = $row['quantity'];

      $query1 = "SELECT quantity FROM products WHERE productId = '$productId'";
      if(!($result1 = mysqli_query($conn, $query1)))
      {
        die('Error: ' . mysqli_error($conn));
      }

      if ($row1 = mysqli_fetch_assoc($result1))
      {
        $newQuantity =  $row1['quantity'] - $quantity;
      }
      else
      {
        $error = "Product not available in invenory";
        return $error;
      }

      $query2 = "UPDATE products SET quantity = '$newQuantity' WHERE productId = '$productId'";
      if(!($result2 = mysqli_query($conn, $query2)))
      {
        die('Error: ' . mysqli_error($conn));
      }

    }
    return $error;
  }

  public function getOrderID()
  {


      return $this->ID;

  }

  public function getCustomerID()
  {
    return $this->customerId;
  }

  public function getSubTotal()
  {
    return number_format($this->subTotal, 2, '.', '');
  }

  public function getTax()
  {
    return number_format($this->tax, 2, '.', '');
  }

  public function getFedTax()
  {
    return $this->FED_TAX ;
  }


  public function getTotal()
  {
    return number_format($this->total, 2, '.', '');
  }





  public function getDateOfPurchase($orderId)
  {
      require "login-Database.inc.php";
      $error = "";
      $query1 = "SELECT dateOfPurchase FROM orderproducts WHERE OrderID = '$orderId' LIMIT 1";
      if(!($result1 = mysqli_query($conn, $query1)))
      {
        die('Error: ' . mysqli_error($conn));
      }

      if ($row1 = mysqli_fetch_assoc($result1))
      {
        return $row1['dateOfPurchase'];
      }
      else
      {
        $error = "Order not found";
      }

      return $error;

  }


}
