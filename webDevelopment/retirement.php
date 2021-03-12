<!DOCTYPE html>

<?php
//Definition and initialization of variables with empty values
$ageErr = $salaryErr = $percentSavedErr = $savingsGoalErr = "";
$age = $salary = $percentSaved = $savingsGoal = $userSavings = $employerMatchOfSavings = $yearlySavings = $goal = $goalResult = "";

$placeholderReplacement = True;

if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	//Checks if age is empty
	if(empty($_POST["age"]) && !is_numeric($_POST['age']))
	{
		$ageErr = "Your age must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$age = sanitizeString($_POST["age"]);
	//Checks if age only contains numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $age))
	{
		$ageErr = "Your age must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if salary is empty
	if(empty($_POST["salary"]) && !is_numeric($_POST['salary']))
	{
		$salaryErr = "Your salary must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$salary = sanitizeString($_POST["salary"]);
	//Checks if salary only contains numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $salary))
	{
		$salaryErr = "Your salary must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if percentSaved is empty
	if(empty($_POST["percentSaved"]) && !is_numeric($_POST['percentSaved']))
	{
		$percentSavedErr = "Your percentSaved must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$percentSaved = sanitizeString($_POST["percentSaved"]);
	//Checks if percentSaved contains only numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $percentSaved))
	{
		$percentSavedErr = "Your percentSaved must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if savingsGoal is empty
	if(empty($_POST["savingsGoal"]) && !is_numeric($_POST['savingsGoal']))
	{
		$savingsGoalErr = "Your savingsGoal must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$savingsGoal = sanitizeString($_POST["savingsGoal"]);
	//Checks if savingsGoal contains only numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $savingsGoal))
	{
		$savingsGoalErr = "Your savingsGoal must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Calculates retirement goal
	if(isset($_POST["submit"]) && $placeholderReplacement == True)
	{
		$userSavings = $salary * $percentSaved;
		$employerMatchOfSavings = $userSavings * 0.35;
		$yearlySavings = $userSavings + $employerMatchOfSavings;
		$goal = $savingsGoal / $yearlySavings;
		$goalResult = $age + $goal;
		$goalResult = (round($goalResult, 2));
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
    <title>Retirement Calculator</title>
    <style>
        .error {
          color: #FF0000;
        }
    </style>
</head>

<body>
    <h1>Retirement <span style="font-style:italic; font-weight:bold; color: maroon"> Calculator</h1>

    <p><span class="error">All form fields must be completed for the BMI calculator to function.</span></p>

    <form method="post" action="retirement.php">

        Age: <input type="text" size="4" name="age" value="<?php echo isset($_POST["age"]) ? $_POST["age"] : ''; ?>">
        <span class="error"><?php echo $ageErr;?></span>
        <br><br>

        Salary: <input type="text" size="4" name="salary" value="<?php echo isset($_POST["salary"]) ? $_POST["salary"] : ''; ?>">
        <span class="error"><?php echo $salaryErr;?></span>
        <br><br>
		
		Percent Saved: <input type="text" size="4" name="percentSaved" value="<?php echo isset($_POST["percentSaved"]) ? $_POST["percentSaved"] : ''; ?>">
        <span class="error"><?php echo $percentSavedErr;?></span>
        <br><br>
		
		Saving's Goal: <input type="text" size="4" name="savingsGoal" value="<?php echo isset($_POST["savingsGoal"]) ? $_POST["savingsGoal"] : ''; ?>">
        <span class="error"><?php echo $savingsGoalErr;?></span>
        <br><br>
		
		<span style="font-weight: bold;">
		<?php 
		if(isset($_POST["submit"]) && $placeholderReplacement == True)
		{ 
			if($goalResult < 100)
			{
			echo "You will reach your goal at the age of" . " " . $goalResult . ".";
			echo "<br><br>";
			}else{
                echo "Unfortunately, you have died and did not reach your savings goal.";
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
