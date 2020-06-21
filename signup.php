<?php include('header.php'); 
?>

<!DOCTYPE html>
<html>
	<head>
		<title>soapbox - sign up</title>
	</head>

	<body>
		<form action="confirmation.php" method="POST" enctype="multipart/form-data">
			<br> Avatar <br>
			<input type="file" name="avatar" id="fileToUpload">

			<br> Username: <br>
			<input type="text" name="username" maxlength="26" placeholder="Username">
            
			<br> Password: <br> 
	    	<input type="password" name="password" maxlength="26" placeholder="Password">
            
			<br> Email Address: <br>
	    	<input type="email" name="email" placeholder="Email Address">

	    	<p>Bio: </p><textarea name="bio" placeholder="Bio..." rows="5" style="resize: none;"></textarea>

			<br>
			<input type="submit" value="Submit">
        </form>
    </body>
<!--Include footer later on -->
</html>
