<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Category</title>
<style>
td, th { 
border: 1px solid; 
text-align: center; 
padding: 0.5em; } 
</style>
</head>

<body>	
<?php
require_once 'login.php';

//Establishes connection to database
$conn = mysqli_connect($hn, $un, $pw, $db);

if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Variable recieved from ajax call used to query database
$categorySelected = $_POST['theCategory'];
//Query the database
$query = "SELECT * FROM classics WHERE category ='" . $categorySelected. "'";
$result = $conn->query($query);

//Outputs data
echo "<h1>Current Inventory by Category</h1>";
echo "Our current book inventory includes the following books in the" . " " . $categorySelected . " " . "category." . "<br>" . "<br>";

echo '<table> 
      <tr> 
          <th>Title</th> 
          <th>Author</th> 
          <th>Category</th> 
          <th>Year</th> 
          <th>ISBN</th> 
      </tr>';

if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $column1 = $row["title"];
        $column2 = $row["author"];
        $column3 = $row["category"];
        $column4 = $row["year"];
        $column5 = $row["isbn"]; 
 
        echo '<tr> 
                  <td>'.$column1.'</td> 
                  <td>'.$column2.'</td> 
                  <td>'.$column3.'</td> 
                  <td>'.$column4.'</td> 
                  <td>'.$column5.'</td> 
              </tr>';
	}
	echo"</table>";
	$result->free();
}

?>
</body>

</html>