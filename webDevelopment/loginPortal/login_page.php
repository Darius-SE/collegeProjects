<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Log in to Website</title>
        <style>
            input {
                margin-bottom: 0.5em;
            }
        </style>
    </head>
    <body>
        <?php
          // Is someone already logged in? If so, forward them to the correct
          // page. (HINT: Implement this last, you cannot test this until
          //              someone can log in.)
          
          
          // Were a username and password provided? If so check them against
          // the database.
          
          
          //      If username / password were valid, set session variables
          //      and forward them to the correct page
          
          
          //      If the username / password were not valid, show error message
          //      and populate form with the original inputs
        
		//Include login.php file
		require_once 'login.php';
		
		//Attempt to connect to MySQL database
		$connectTo = mysqli_connect($hn, $un, $pw, $db);

		if(mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		//Definition and initialization of variables with empty values
		$username = $password = "";
		$usernameErr = $passwordErr = $sessionErr = "";
		$errorDecider = True;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//Checks if username is empty
			if(empty($_POST["username"]))
			{
				$usernameErr = "Please enter a valid username";
				$errorDecider = False;
			}else{
				$username = sanitizeString($_POST["username"]);
			//Checks if username only contains letters and whitespace
			if(!preg_match("/^[a-zA-Z ]*$/", $username))
			{
				$usernameErr = "Please enter a valid username.";
				$errorDecider = False;
			}
			$sqlOne = "SELECT * FROM lab4_users WHERE username ='" . $username. "' LIMIT 1";
			$sqlResultOne = $connectTo->query($sqlOne);
			$rowOne = mysqli_fetch_assoc($sqlResultOne);
			//Checks if the username is valid by matching the entered username with the ones in the database
			if($rowOne['username'] != $username)
			{
				$usernameErr = "Please enter a valid username.";
				$errorDecider = False;
			}
			}
		
			//Checks if password is empty
			if(empty($_POST["password"]))
			{
				$passwordErr = "Please enter a valid password.";
				$errorDecider = False;
			}else{
				$password = sanitizeString($_POST["password"]);
			
			$sqlTwo = "SELECT * FROM lab4_users WHERE username ='" . $username. "' LIMIT 1";
			$sqlResultTwo = $connectTo->query($sqlTwo);
			$rowTwo = mysqli_fetch_assoc($sqlResultTwo);
			
			//Hashes password that the user enters
			$salt1 = "qm&h*";
			$salt2 = "pg!@";
			$token = hash('ripemd128', "$salt1$password$salt2");
			
			//Checks if the password is valid by matching the entered password with the ones in the database
			if($rowTwo['password'] != $token)
			{
				$passwordErr = "Please enter a valid password.";
				$errorDecider = False;
			}
			}
			
			//Checks if user is an admin or regular user and redirect them accordingly
			if(isset($_POST["submit"]) && $errorDecider == True)
			{	
				$query = "SELECT * FROM lab4_users WHERE username ='" . $username. "' LIMIT 1";
				$result = $connectTo->query($query);
				
				//If true, user found
				if(mysqli_num_rows($result) == 1)
				{
					//Checks if user is admin or regular user
					$row = mysqli_fetch_assoc($result);
					if($row['type'] == 'admin' && $row['password'] == $token)
					{
						$_SESSION['admin'] = $username;
						header("location: admin_page.php");
					}
					
					if($row['type'] == 'user' && $row['password'] == $token)
					{
						$_SESSION['user'] = $username;
						header("location: user_page.php");
					}
					
				}
			}
		}
		//Checks if user or admin is already logged in.
		if(isset($_SESSION['admin']))
		{
			header("Location: admin_page.php");
		}
			
		if(isset($_SESSION['user']))
		{
			header("Location: user_page.php");
		}
		
          
        ?>
        <h1>Welcome to <span style="font-style:italic; font-weight:bold; color: maroon">
                Great Web Application</span>!</h1>
                
        <p style="color: red">
        <!--Placeholder for error messages-->
		<span class="error"><?php echo $usernameErr;?></span><br>
		<span class="error"><?php echo $passwordErr;?></span><br>
        </p>
        
        <form method="post" action="login_page.php">
            <label>Username: </label>
            <input type="text" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>"> <br>
            <label>Password: </label>
            <input type="password" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>"> <br>
            <input type="submit" name="submit" value="Log in">
        </form>
        
        <p style="font-style:italic">
		<!--
            Placeholder for "forgot password" link<br><br>
            Placeholder for "create account" link
			-->
        </p>
</html>
<?php
// place useful functions here
// examples: salt and hash a string
//           check to see if a username/password combination is valid
//           forward user or admin to the correct page

//Sanitizes input upon calling
function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}

?>
