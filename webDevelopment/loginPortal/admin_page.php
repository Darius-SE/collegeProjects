<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administrator Page</title>
    </head>
    <body>
        <h1>Administrator Page</h1>
        <?php
            // is an Admin logged in?
	

            // if so, show Admin content
            // (nothing deeper than saying hey, you're an admin, here's your name as well)


            //if not, show message and link to login form
		
		if(isset($_SESSION['admin']) && !isset($_SESSION['user']))
		{
			echo "Hey, " . $_SESSION['admin'] . ". You're an admin" . "<br>" . "<br>";
			echo "<a href='logout_page.php'>Logout</a>";
		}
		
		if(!isset($_SESSION['admin']) && isset($_SESSION['user']))
		{
			echo "You must login first." . "<br>" . "<br>";
			echo "Wrong user type access. ";
			echo "<a href='login_page.php'>Login</a>" . "<br>" . "<br>";
			
		}
		
		if(isset($_SESSION['admin']) == null && isset($_SESSION['user']) == null)
		{
			echo "You must login first." . "<br>" . "<br>";
			echo "<a href='login_page.php'>Login</a>";
		}
		

        ?>
    </body>
</html>
