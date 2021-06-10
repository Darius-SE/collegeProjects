<?php
	$hn = 'localhost';
	$un = 'root';
	$pw = '';  // phpMyAdmin password
	$db = 'sparkling jewels';  // database name, should be netID

  $conn = mysqli_connect($hn, $un, $pw, $db);
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to Mysqli: " . mysqli_connect_error();
  }
?>
