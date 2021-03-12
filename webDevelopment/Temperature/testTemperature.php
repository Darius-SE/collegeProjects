<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Temperature</title>
<style>
td, th { 
border: 1px solid; 
text-align: center; 
padding: 0.5em; } 
</style>
</head>

<body>
<?php
require_once 'Temperature.php';
//Initialization of start temperature
$startTemp = 0;

//Declaration of the type of temperature
$definedType = 'C';
$variable = new Temperature($startTemp, $definedType);
echo "<table class = 'center'>";
	echo "<tr>";
		echo "<th colspan = 5> Celsius starts at 0, increments by 10</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>Celsius</th>" . "<th>Kelvin</th>" . "<th>Fahrenheit</th>";
			echo "<th>Boiling</th>" . "<th>Freezing</th>";
	echo "</tr>";
	for ($i = 0; $i < 10; $i++)
	{
		if($i == 0)
		{
			$variable->incrementTemp(0, $definedType);
		}else{
			$variable->incrementTemp(10, $definedType);
		}
		
		echo "<tr>";
		echo "<td>" . $variable->getCelsius() . "</td>";
		echo "<td>" . $variable->getKelvin()  . "</td>";
		echo "<td>" . $variable->getFahren()  . "</td>";
		echo "<td>" . $variable->isBoiling()  . "</td>";
		echo "<td>" . $variable->isFreezing() . "</td>";
		echo "</tr>";
	}
	echo "</table>";

require_once 'Temperature.php';
//Initialization of start temperature
$startTemp2 = 0;

//Declaration of the type of temperature
$definedType2 = 'K';

//Creates instance of Temperature
$variable2 = new Temperature($startTemp2, $definedType2);

//Creates table
echo "<table class = 'center'>";
	echo "<tr>";
		echo "<th colspan = 5> Celsius starts at 0, increments by 20</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>Celsius</th>" . "<th>Kelvin</th>" . "<th>Fahrenheit</th>";
			echo "<th>Boiling</th>" . "<th>Freezing</th>";
	echo "</tr>";
	for ($i = 0; $i < 10; $i++)
	{
		if($i == 0)
		{
			$variable2->incrementTemp(0, $definedType2);
		}else{
			$variable2->incrementTemp(20, $definedType2);
		}
		
		echo "<tr>";
		echo "<td>" . $variable2->getCelsius() . "</td>";
		echo "<td>" . $variable2->getKelvin()  . "</td>";
		echo "<td>" . $variable2->getFahren()  . "</td>";
		echo "<td>" . $variable2->isBoiling()  . "</td>";
		echo "<td>" . $variable2->isFreezing() . "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>


</body>
</html>
