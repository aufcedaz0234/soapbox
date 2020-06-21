<?php

include('header.php');
include('user.php');

require('dbcon/dbcon.php');

// convert class to PDO

	// if fields in form are set and submitted, check if user exists and is logged in or not
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usernameI = $_POST['username'];
	$user = new User();

	// rename variable in ln 15 to 'row'
	$username_in_database = $user->getUserCredentials($pdo, $usernameI); // get username using method from user.php
	$password = $_POST['password'];
		// if username and password match, init session and redirect to another page.
	if ($username_in_database['username'] == $usernameI && password_verify($password, $username_in_database['password'])) {
			$_SESSION['logged_in_user'] = $usernameI; // set to IDnum later on...
			$_SESSION['username'] = $usernameI;		
			// check if the user is logged in
			// if so, redirect to main page for logged-in users.
			if (isset($_SESSION['logged_in_user'])) {
				$_SESSION['logged_in_user'] = TRUE;
				header('Location: main.php');

			} else {
				// not logged in, keep on same page...
				session_destroy();
				exit();
			}
	} else if ($usernameI != $username_in_database['username'] || $password != $username_in_database['password']) {
			echo "Incorrect username or password.";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>soapbox - log in</title>
	</head>
	<body>
		<form action="" method="POST">
			<br><input type="text" name="username" placeholder="Username"><br>
			<br><input type="password" name="password" placeholder="Password"><br>
			<input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>
