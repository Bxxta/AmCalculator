<?php 
if (!isset($_COOKIES['asd']))
{
include("class/cookies.php");
cookies ();
}

?>

<!DOCTYPE html>
<html>
	<html lang="pl">
	<head>
	<meta charset= "utf-8">
	<meta author = "maternicki patryk">
	<title>AmCalculator - Easy for your life</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
	</head>
		<body>
		<?php
		include ("class/stats.php");
		stats();
		?>
		
		<?php
		include ("class/form.php");
		getForm();
		?>
		<br>
		
		<?php
		include ("class/summary.php");
		if ($use == 1)
		{
		Summary();
		}
		
		?>
		</body>
</html>
	