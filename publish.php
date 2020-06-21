<?php
include('header.php');
require('dbcon/dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>soapbox - publish a blog post</title>
	<link rel="stylesheet" type="text/css" href="/soapbox/css/publish.css">
</head>
<body>
	<div class="wrapper">
		<form action="publish.php" method="POST">
			<br><span class="asterik">*</span><span> Post Title: </span><input type="text" name="postTitle" placeholder="Blog post title..."><br>
			<br><span class="body-span"><span class="asterik">*</span> Post Body: </span><textarea name="postBody" style="resize: none;" placeholder="Blog post body..." rows="20" cols="50"></textarea><br>
			<br><input type="submit" name="submitBlogPost" value="Publish!">
		</form>
	</div>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$postTitle = $_POST['postTitle'];
	$postBody = $_POST['postBody'];
	
	// if post body and title are not empty, insert into db.
	if (!(empty($postTitle)) && !(empty($postBody))) {
		$sql = "INSERT into posts0 (post_title, post_body) VALUES ('$postTitle', '$postBody')";
		$result = mysqli_query($conn, $sql);
	} else {
?>
		<span class="error-msg">* Please fill in all required fields.</span>
<?php
	}
}
?>