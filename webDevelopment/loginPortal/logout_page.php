<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Logged Out</title>
    </head>
    <?php
        // remove session and session cookie
	session_destroy();
    ?> 
    <body>
        <h1>Logged Out</h1>
        <p>
            You are now logged out of the website.
        </p>
        <p>
            <a href="login_page.php">Log in</a> again.
        </p>
    </body>
</html>