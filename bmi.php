<!DOCTYPE html>

<?php
//Definition and initialization of variables with empty values
$weightErr = $feetErr = $inchesErr = "";
$weight = $feet = $inches = $newWeight = $newHeight = $squaredResult = $resultBMI = "";

$placeholderReplacement = True;

if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	//Checks if weight is empty
	if(empty($_POST["weight"]) && !is_numeric($_POST['weight']))
	{
		$weightErr = "Your weight must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$weight = sanitizeString($_POST["weight"]);
	//Checks if weight only contains numbers between 0.0 and 4.0
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $weight))
	{
		$weightErr = "Your weight must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if feet is empty
	if(empty($_POST["feet"]) && !is_numeric($_POST['feet']))
	{
		$feetErr = "Your height in feet must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$feet = sanitizeString($_POST["feet"]);
	//Checks if feet only contains numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $feet))
	{
		$feetErr = "Your height in feet must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if inches is empty
	if(empty($_POST["inches"]) && !is_numeric($_POST['inches']))
	{
		$inchesErr = "Your height in inches must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$inches = sanitizeString($_POST["inches"]);
	//Checks if inches contains only numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $inches))
	{
		$inchesErr = "Your height in inches must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Calculates BMI
	if(isset($_POST["submit"]) && $placeholderReplacement == True)
	{
		$newWeight = $weight * 0.45;
		$newHeight = (($feet * 12) + $inches) * 0.025;
		$squaredResult = $newHeight * $newHeight;
		$resultBMI = $newWeight / $squaredResult;
		$resultBMI = (round($resultBMI, 2));
	}

}

//Sanitizes input upon calling
function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}
?>

<html lang="en">

<head>
    <title>BMI Calculator</title>
    <style>
        .error {
          color: #FF0000;
        }
    </style>
</head>

<body>
    <h1>BMI <span style="font-style:italic; font-weight:bold; color: maroon"> Calculator</h1>

    <p><span class="error">All form fields must be completed for the BMI calculator to function.</span></p>

    <form method="post" action="bmi.php">

        Weight: <input type="text" size="4" name="weight" value="<?php echo isset($_POST["weight"]) ? $_POST["weight"] : ''; ?>">
        <span class="error"><?php echo $weightErr;?></span>
        <br><br>

        Feet: <input type="text" size="4" name="feet" value="<?php echo isset($_POST["feet"]) ? $_POST["feet"] : ''; ?>">
        <span class="error"><?php echo $feetErr;?></span>
        <br><br>
		
		Inches: <input type="text" size="4" name="inches" value="<?php echo isset($_POST["inches"]) ? $_POST["inches"] : ''; ?>">
        <span class="error"><?php echo $inchesErr;?></span>
        <br><br>
		
		<span style="font-weight: bold;">
		<?php 
		if(isset($_POST["submit"]) && $placeholderReplacement == True)
		{ 
			echo "Your BMI is" . " " . $resultBMI . ".";
			echo "<br><br>";
			
			if($resultBMI < 18.5)
			{
                echo "You are underweight.";
			}

            if($resultBMI >= 18.5 and $resultBMI <= 24.9)
			{
                echo "You are within the normal weight range.";
			}

            if($resultBMI >= 25 and $resultBMI <= 29.9)
			{
                echo "You are overweight.";
			}
			
            if($resultBMI >= 30)
			{
                print("You are unfortunately obese.");
			}
		}
		?>
		</span>
		<br><br>
        <input type="submit" name="submit" value="Calculate">
		
		<p>
            <a href="choice.php">Go Back</a>
        </p>

    </form>

</body>

</html>
