
<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

$_SESSION['nav'] = "products";
require "header.php";


$isCustomer = false;
if(isset($_SESSION['user']))
{
	$user = unserialize($_SESSION['user']);
  if(!($user->isAdmin()))
  {
    $isCustomer = true;
  }
	else
	{
		$isCustomer = false;
	}
}
else
{
  	$isCustomer = false;
}

require_once "include/classes.inc.php";



//Boolean variable to check if searched value matches the name of the product in the database
$noProducts = false;


//Query database to get product details
$queryNoFilter = "SELECT * FROM products";


$queryHighFilter = "SELECT * FROM products ORDER BY price DESC";


$queryLowFilter = "SELECT * FROM products ORDER BY price ASC";

if(isset($_POST['detailsBtn']))
{
	//Data that would be sent to product details page
	if (session_status() == PHP_SESSION_NONE)
	{
			session_start();
	}

	$_SESSION['productId'] = $_POST['productId'];
	header("location: productDetails.php");
}
if (session_status() == PHP_SESSION_NONE)
{
		session_start();
}
if(isset($_POST['cartBtn']))
{
	echo "wwo1";
	$user->accessCart()->addToCart($_POST['productId'], 1);
	header("location: shopping cart.php");
}

?>
<div class="container">
  <div class="main">

	<br>
	<form method="post">

	<input class="search" type="text" name="searchName" placeholder="Search Products">
    <button class="searchButton" name="searchBtn"><i class="fa fa-search"></i></button>
	<br><br>

    <select class="select" name="sortValue">
		<option>-----SELECT-----</option>
        <option>Price: High-Low</option>
		<option>Price: Low-High</option>
    </select>
	<input type="submit" name="submit" value="Filter">

	</form>
	<br><br>

	<?php
	//Declaration and Initialization of variables
	$searchName = "";

	$inv = new Inventory();
	//Checks if select value is set
	if(isset($_POST['sortValue']))
	{
		$sortValue = $_POST['sortValue'];
	}
	else{
		$sortValue = "";
	}


	echo "<h2 class = 'heading' align='center' style = 'margin-bottom: 40px;'>Sparkling Products</h2><br>";

	if(isset($_POST["searchBtn"]) && !isset($_POST["submit"]))
	{
		//Checks if search is empty
		if(empty($_POST["searchName"]))
		{
			echo "<h3 align='center'>No Products Found</h3>";
		}
	}

echo "<div class='products-container'>";
	echo "<div class='row'>";

	//Allows user to search for products by name
	if(isset($_POST["searchBtn"]) && !empty($_POST['searchName']))
	{
		$arr = array();
		$searchName = $_POST['searchName'];
		$var1 = "%" . $searchName . "%";

		$arr = $inv->SearchInventoryByName($var1);

	/*	$query = "SELECT * FROM productlist WHERE name LIKE '$var1'";
		$result = mysqli_query($conn, $query);
		$queryResult = mysqli_num_rows($result);*/

		//echo "There are ".$queryResult." results!";

		if(!empty($arr))
		{
			foreach ($arr as $product) {
				$price = $product->getPrice();
				$name = $product->getName();
				$pic = $product->getPicture();
				$productId = $product->getProductId();

				$rating = round($product->getAverageRating());
				echo "<div class='col-md-3'>";
				echo "<div class='product-top'>";
				?>

			 <img src=" <?php echo $pic;?>"><br>
			 <?php
					echo "<div class='overlay'>";
					echo "<form method='post' action='productPage.php'>";
						echo "<button type='submit' class='btn btn-secondary' name='detailsBtn' title='View Details'>";
						echo "<input type='hidden' name='productId' value='$productId'>";
						echo "<i class='fa fa-eye'></i></button>";
					echo "</form>";
					if($isCustomer)
					{
						if($inv->getInventoryQuantity($product->getProductId()) >= 1) {
						echo "<form method='post' action='productPage.php'>";
							echo "<button type='submit'  style = 'margin-top: 10px;' class='btn btn-secondary' name='cartBtn' title='Add to Cart'>";
							echo "<input type='hidden' name='productId' value='$productId'>";
							echo "<i class='fa fa-shopping-cart'></i></button>";
						 echo "</form>";
					 }
					}


					echo "</div>";
				echo "</div>";

				echo "<div class='product-bottom text-center'>";
				for ($i = 1; $i <= $rating; $i++)
				{
					echo "<i class='fa fa-star'></i>";
				}
				echo "<br>";
					echo "<i>$name</i><br>";
					echo "$<i>$price</i>";
				echo "</div>";
				echo "</div>";


			}
		}else{
			$noProducts = true;
		}
	}

	//Sorts products as they are arranged in the database if no filter is selected and/or -----SELECT----- is selected
	if((!isset($_POST["submit"]) || isset($_POST["submit"])) && $sortValue != "Price: High-Low" && $sortValue != "Price: Low-High" && !isset($_POST["searchBtn"]))
	{
		$arr = array();
		$arr = $inv->filter($queryNoFilter);

		foreach ($arr as $product)
		{

			$price = $product->getPrice();
      $name = $product->getName();
      $pic = $product->getPicture();
			$productId = $product->getProductId();

			$rating = round($product->getAverageRating());
			echo "<div class='col-md-3'>";
			echo "<div class='product-top'>";
			?>

		 <img src=" <?php echo $pic;?>"><br>
		 <?php
				echo "<div class='overlay'>";
				echo "<form method='post' action='productPage.php'>";
					echo "<button type='submit' name='detailsBtn' class='btn btn-secondary' title='View Details'>";
					echo "<i class='fa fa-eye'></i></button>";
					echo "<input type='hidden' name='productId' value='$productId'>";
			  echo "</form>";
				if($isCustomer)
				{
					if($inv->getInventoryQuantity($product->getProductId()) >= 1) {
					echo "<form method='post' action='productPage.php'>";
						echo "<button type='submit' style = 'margin-top: 10px;' class='btn btn-secondary' name='cartBtn' title='Add to Cart'>";
						echo "<i class='fa fa-shopping-cart'></i></button>";
						echo "<input type='hidden' name='productId' value='$productId'>";
					 echo "</form>";
				 }
				}
				echo "</div>";
			echo "</div>";

			echo "<div class='product-bottom text-center'>";
			for ($i = 1; $i <= $rating; $i++)
			{
				echo "<i class='fa fa-star'></i>";
			}
			echo "<br>";
				echo "<i>$name</i><br>";
				echo "$<i>$price</i>";
			echo "</div>";
			echo "</div>";


		}
	}

	//Sorts products from prices ranging from High-Low if High-Low filter is selected
	if($sortValue == "Price: High-Low" && !isset($_POST["searchBtn"]))
	{
		$arr = array();
		$arr = $inv->filter($queryHighFilter);


		foreach ($arr as $product)
		{
			$price = $product->getPrice();
			$name = $product->getName();
			$pic = $product->getPicture();
			$productId = $product->getProductId();
			$rating = round($product->getAverageRating());
			echo "<div class='col-md-3'>";
			echo "<div class='product-top'>";
			?>

		 <img src=" <?php echo $pic;?>"><br>
		 <?php
				echo "<div class='overlay'>";
				echo "<form method='post' action='productPage.php'>";
					echo "<button type='submit' name='detailsBtn' class='btn btn-secondary' title='View Details'>";
					echo "<input type='hidden' name='productId' value='$productId'>";
					echo "<i class='fa fa-eye'></i></button>";
				echo "</form>";
				if($isCustomer)
				{
					if($inv->getInventoryQuantity($product->getProductId()) >= 1) {
					echo "<form method='post' action='productPage.php'>";
						echo "<button type='submit' style = 'margin-top: 10px;' class='btn btn-secondary' name='cartBtn' title='Add to Cart'>";
						echo "<i class='fa fa-shopping-cart'></i></button>";
						echo "<input type='hidden' name='productId' value='$productId'>";
					 echo "</form>";
				 }
				}


				echo "</div>";
			echo "</div>";

			echo "<div class='product-bottom text-center'>";
			for ($i = 1; $i <= $rating; $i++)
			{
				echo "<i class='fa fa-star'></i>";
			}
			echo "<br>";
				echo "<i>$name</i><br>";
				echo "$<i>$price</i>";
			echo "</div>";
			echo "</div>";

		/*while($row = $resultHighFilter->fetch_assoc())
		{
			echo "<div class='col-md-3'>";
			echo "<div class='product-top'>";
			echo "<img src=$row[picture]><br>";
				echo "<div class='overlay'>";
				echo "<form method='post' action='productDetails.php'>";
				echo "<button type='submit' class='btn btn-secondary' name='detailsBtn' title='View Details'>";
				echo "<i class='fa fa-eye'></i></button>";
				echo "<button type='submit' class='btn btn-secondary' name='cartBtn' title='Add to Cart'>";
				echo "<i class='fa fa-shopping-cart'></i></button>";
				echo "</form>";
				echo "</div>";
			echo "</div>";

			echo "<div class='product-bottom text-center'>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i><br>";
				echo "<i>$row[name]</i><br>";
				echo "<i>$row[price]</i>";
			echo "</div>";
			echo "</div>";*/
		}
	}

	//Sorts products from prices ranging from Low-High if Low-High filter is selected
	if($sortValue == "Price: Low-High" && !isset($_POST["searchBtn"]))
	{

		if($sortValue == "Price: Low-High" && !isset($_POST["searchBtn"]))
		{
			$arr = array();
			$arr = $inv->filter($queryLowFilter);


			foreach ($arr as $product)
			{
				$price = $product->getPrice();
				$name = $product->getName();
				$pic = $product->getPicture();
				$productId = $product->getProductId();
				$rating = round($product->getAverageRating());
				echo "<div class='col-md-3'>";
				echo "<div class='product-top'>";
				?>

			 <img src=" <?php echo $pic;?>"><br>
			 <?php
					echo "<div class='overlay'>";
					echo "<form method='post' action='productPage.php'>";
						echo "<button type='submit' name='detailsBtn' class='btn btn-secondary' title='View Details'>";
						echo "<i class='fa fa-eye'></i></button>";
						echo "<input type='hidden' name='productId' value='$productId'>";
					echo "</form>";
					if($isCustomer)
					{
						if($inv->getInventoryQuantity($product->getProductId()) >= 1) {
						echo "<form method='post' action='productPage.php'>";
							echo "<button type='submit'  style = 'margin-top: 10px;' class='btn btn-secondary' name='cartBtn' title='Add to Cart'>";
							echo "<i class='fa fa-shopping-cart'></i></button>";
							echo "<input type='hidden' name='productId' value='$productId'>";
						 echo "</form>";
					 }
					}


					echo "</div>";
				echo "</div>";

				echo "<div class='product-bottom text-center'>";
				for ($i = 1; $i <= $rating; $i++)
				{
					echo "<i class='fa fa-star'></i>";
				}
				echo "<br>";
					echo "<i>$name</i><br>";
					echo "$<i>$price</i>";
				echo "</div>";
				echo "</div>";


		/*while($row = $resultLowFilter->fetch_assoc())
		{
			echo "<div class='col-md-3'>";
			echo "<div class='product-top'>";
			echo "<img src=$row[picture]><br>";
				echo "<div class='overlay'>";
				echo "<form method='post' action='productDetails.php'>";
				echo "<button type='submit' class='btn btn-secondary' name='detailsBtn' title='View Details'>";
				echo "<i class='fa fa-eye'></i></button>";
				echo "<button type='submit' class='btn btn-secondary' name='cartBtn' title='Add to Cart'>";
				echo "<i class='fa fa-shopping-cart'></i></button>";
				echo "</form>";
				echo "</div>";
			echo "</div>";

			echo "<div class='product-bottom text-center'>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i>";
			echo "<i class='fa fa-star'></i><br>";
				echo "<i>$row[name]</i><br>";
				echo "<i>$row[price]</i>";
			echo "</div>";
			echo "</div>";*/
		}
	}
}

	//If search doesn't matches any product name in the database, the user is notified that there are no products found matching their search value
	if($noProducts)
	{
		echo "<h3 align='center' class = 'h3'>No Products Found</h3>";
	}

	echo "</div>";
	echo "</div>";

	?>

<br><br><br><br>
</div>
</div>

<?php require "footer.php" ?>
</body>
</html>
