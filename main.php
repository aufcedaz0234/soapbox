<?php
include('header.php');
include('functions.php');

$helperFunctionsClass = new helperFunctions();
$helperFunctionsClass->isLoggedIn();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>soapbox - main page</title>
		<link rel="stylesheet" type="text/css" href="/css/main.css">
	</head>
	<body>
		<div class="container">
			<section class="section">
				<h3>Fresh From the Factory</h3>
				<caption>Recently uploaded videos.</caption>
				<?php?>
			</section>
			<section class="section">
				<h3>Top of the Trends</h3>
				<caption>The trendiest trends of all trends.</caption>
				<?php?>
			</section>
			<section class="section">
				<h3>In the Red</h3>
				<caption>If you aren't in the black, you must be in the red.</caption>
				<?php?>
			</section>
		</div>
	</body>
</html>
