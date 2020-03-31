<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Choice</title>
		<style>
			input[type=submit] {
				width: 20em;  height: 2em;
			}
		</style>
    </head>

    <body>
		<?php
		if(isset($_POST["submit"]) && !isset($_POST["submit2"]))
		{
			header("Location: bmi.php");
		}
		
		if(isset($_POST["submit2"]) && !isset($_POST["submit"]))
		{
			header("Location: retirement.php");
		}
		?>
        <h1 align="center">Choice <span style="font-style:italic; font-weight:bold; color: maroon"> of Calculation</h1>
		<div class="content" style="text-align:center">
		<form method="post" action="choice.php">
            <input type="submit" name="submit" value="BMI Calculator">
			<input type="submit" name="submit2" value="Retirement Calculator">
        </form>
		</div>

    </body>
</html>