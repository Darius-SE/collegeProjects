<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Page</title>
    </head>
    <body>
        <h1>User Page</h1>
        <?php
            // is a User logged in?
			
            // if so, welcome them back using their name


            // if not, show message and link to login page

		if(isset($_SESSION['user']) && !isset($_SESSION['admin']))
		{
			echo "Welcome back, " . $_SESSION['user'] . "." . "<br>" . "<br>";
			echo "<a href='logout_page.php'>Logout</a>";
		}
		
		if(!isset($_SESSION['user']) && isset($_SESSION['admin']))
		{
			echo "You must login first." . "<br>" . "<br>";
			echo "Wrong user type access. ";
			echo "<a href='login_page.php'>Login</a>";
		}
		
		if(isset($_SESSION['user']) == null && isset($_SESSION['admin']) == null)
		{
			echo "You must login first." . "<br>" . "<br>";
			echo "<a href='login_page.php'>Login</a>";
		}
		

        ?>
    </body>
</html>
