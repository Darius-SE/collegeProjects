<!DOCTYPE html>

<?php
//Definition and initialization of variables with empty values
$nameErr = $emailErr = $agreeErr = $currentGPAErr = $currentCreditsErr = $newCreditsErr = $GPAincreaseErr = "";
$name = $email = $agree = $currentGPA = $currentCredits = $newCredits = $GPAincrease = $currentGPAhours = $desiredGPA = $desiredGPAhours = $GPAhoursincrease = $newGPA = "";

$placeholderReplacement = True;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//Checks if name is empty
	if(empty($_POST["name"]))
	{
		$nameErr = "Your name must consist of letters and white space";
		$placeholderReplacement = False;
	}else{
		$name = sanitizeString($_POST["name"]);
	//Checks if name only contains letters and whitespace	
	if(!preg_match("/^[a-zA-Z ]*$/", $name))
	{
		$nameErr = "Your name must consist of letters and white space";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if email is empty
	if(empty($_POST["email"]))
	{
		$emailErr = "Invalid email format";
		$placeholderReplacement = False;
	}else{
		$email = sanitizeString($_POST["email"]);
	//Checks if e-mail address is well-formed
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$emailErr = "Invalid email format";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if user agrees to the terms and conditions
	if(!isset($_POST["agree"]))
	{
		$agreeErr = "You must agree to the terms and conditions";
		$placeholderReplacement = False;
	}else{
		$agree = $_POST["agree"];
	}
	
	//Checks if currentGPA is empty
	if(empty($_POST["currentGPA"]) && !is_numeric($_POST['currentGPA']))
	{
		$currentGPAErr = "Your current GPA must be a number between 0.0 and 4.0";
		$placeholderReplacement = False;
	}else{
		$currentGPA = sanitizeString($_POST["currentGPA"]);
	//Checks if currentGPA only contains numbers between 0.0 and 4.0
	if(!preg_match("/^(?:4(?:\.0)?|[0-3](?:\.[0-9]+)?|0?\.[1-9]+)?$/", $currentGPA))
	{
		$currentGPAErr = "Your current GPA must be a number between 0.0 and 4.0";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if currentCredits is empty
	if(empty($_POST["currentCredits"]) && !is_numeric($_POST['currentCredits']))
	{
		$currentCreditsErr = "Your current number of credits must be a positive integer";
		$placeholderReplacement = False;
	}else{
		$currentCredits = sanitizeString($_POST["currentCredits"]);
	//Checks if currentCredits only contains numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $currentCredits))
	{
		$currentCreditsErr = "Your current number of credits must be a positive integer";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if newCredits is empty
	if(empty($_POST["newCredits"]) && !is_numeric($_POST['newCredits']))
	{
		$newCreditsErr = "(the number of credits this semester must be an integer greater than 0)";
		$placeholderReplacement = False;
	}else{
		$newCredits = sanitizeString($_POST["newCredits"]);
	//Checks if newCredits contains only numbers and one decimal point
	if(!preg_match("/^[1-9]+(\\.[1-9]+)?$/", $newCredits))
	{
		$newCreditsErr = "(the number of credits this semester must be an integer greater than 0)";
		$placeholderReplacement = False;
	}
	}
	
	//Checks if GPAincrease is empty
	if(empty($_POST["GPAincrease"]) && !is_numeric($_POST['GPAincrease']))
	{
		$GPAincreaseErr = "(your desired GPA increase must be a positive value)";
		$placeholderReplacement = False;
	}else{
		$GPAincrease = sanitizeString($_POST["GPAincrease"]);
	//Checks if GPAincrease only contains numbers and one decimal point
	if(!preg_match("/^[0-9]+(\\.[0-9]+)?$/", $GPAincrease))
	{
		$GPAincreaseErr = "(your desired GPA increase must be a positive value)";
		$placeholderReplacement = False;
	}
	}
	
	//Calculates GPA goal
	if(isset($_POST["submit"]) && $placeholderReplacement == True)
	{
		$currentGPAhours = $currentGPA * $currentCredits;
		$desiredGPA = $currentGPA + $GPAincrease;
		$desiredGPAhours = $desiredGPA * ($currentCredits + $newCredits);
		$GPAhoursincrease = $desiredGPAhours - $currentGPAhours;
		$newGPA = $GPAhoursincrease / $newCredits;
		$newGPA = (round($newGPA, 2));
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
    <title>GPA Improvement Calculator</title>
    <style>
        .error {
          color: #FF0000;
        }
    </style>
</head>

<body>
    <h1>GPA Improvement Calculator</h1>

    <p><span class="error">All form fields must be completed for the GPA calculator to function.</span></p>

    <form method="post" action="improveGPA.php">
        
        Name: <input type="text" size="35" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
        <span class="error"><?php echo $nameErr;?></span>
        <br><br>

        E-mail: <input type="text" size="35" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
        <span class="error"><?php echo $emailErr;?></span>
        <br><br>

        <input type="checkbox" name="agree" value="1" <?php if(isset($_POST["agree"])) echo "checked='checked'"; ?>>
        I agree to the terms and conditions of this website.
        <span class="error"><?php echo $agreeErr;?></span>
        <br><br>

        Current GPA: <input type="text" size="4" name="currentGPA" value="<?php echo isset($_POST["currentGPA"]) ? $_POST["currentGPA"] : ''; ?>">
        <span class="error"><?php echo $currentGPAErr;?></span>
        <br><br>

        Current Total Credits: <input type="text" size="3" name="currentCredits" value="<?php echo isset($_POST["currentCredits"]) ? $_POST["currentCredits"] : ''; ?>">
        <span class="error"><?php echo $currentCreditsErr;?></span>
        <br><br>

        I am taking <input type="text" size="3" name="newCredits" value="<?php echo isset($_POST["newCredits"]) ? $_POST["newCredits"] : ''; ?>">
        <span class="error"><?php echo $newCreditsErr;?></span> credits this semester.

        If I want to raise my GPA
        <input type="text" size="4" name="GPAincrease" value="<?php echo isset($_POST["GPAincrease"]) ? $_POST["GPAincrease"] : ''; ?>">
        <span class="error"><?php echo $GPAincreaseErr;?></span> points,
        I need a <span style="font-weight: bold;"><?php if(isset($_POST["submit"]) && $placeholderReplacement == True) echo $newGPA;  else echo "????";?></span> GPA on my courses this semester.
        <br><br>

        <input type="submit" name="submit" value="Calculate">

    </form>

</body>

</html>
