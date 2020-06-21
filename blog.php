<?php
include('header.php');
require('dbcon/dbcon.php');
?>

<?php
	$sql = "SELECT post_title, post_body, post_date from posts0";
	$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>soapbox - dbk's blog</title>
</head>
<body>
	<div class="container">
		<?php
			while ($row = mysqli_fetch_array($result)) {
				echo "<h1>" . $row['post_title'] . "</h1>";
				echo "<i>Published: " . $postDate = date('F j, Y', strtotime($row['post_date'])) . " at " . date('g:i A', strtotime($row['post_date'])) . "</i>";
				echo "<p class='body'>" . nl2br($row['post_body']) . "</p>";
				echo "<hr>";
			}
		?>
	</div>

	<style type="text/css">
		.container {
			margin-right: 300px;
			margin-left: 300px;
		}

		.body {
			text-indent: 40px;
		}
	</style>
</body>
</html>