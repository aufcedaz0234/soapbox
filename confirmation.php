<?php
include('header.php');
include('createUser.php');
require('dbcon/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $createUser = new createUser();
    $createUser->addUser($pdo);
	// if username exists do not continue...
	/*if (mysqli_num_rows($result) > 0) {
		header('Location: /soapbox/signup.php');
		// let user know that username is taken...
	} else {
		// avatar file constraints checks...
		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$fileNameNew = uniqid($_SESSION['username'], true) . "." . $fileActualExt;
					$fileDestination = 'uploads/' . $fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);

				} else {
					echo "Your file is too big!";
				}
			} else {
				echo "There was an error uploading your file" . $fileError . $fileSize;
			}
		} else if (!(empty(in_array($fileActualExt, $allowed))) && !($allowed)) {
			echo "Cannot upload file of this type!";
		}

		mkdir("channel/" . $username);
		mkdir("channel/" . $username . "/videos");
		fopen("channel/" . $username . "/index.php", "w");

		$account_open_date = date("Y-m-d h:i:s");
		$current_date = date("Y-m-d h:i:s");

		// if-then-else-if statement to get rid of the fileDestination var undefined error when avatar photo is not submitted....
		if (!(empty($fileDestination))) {
			$sqlinsert = "INSERT INTO profiles001 (username, password, email, c_status, bio) VALUES ('$username', '$hashed_password', '$email', '$confirmation_status', '$bio')";
		} else if (empty($fileDestination)) {
			$fileDestination = "assets/soap.jpg";
			$sqlinsert = "INSERT INTO profiles001 (username, password, email, c_status, bio) VALUES ('$username', '$hashed_password', '$email', '$confirmation_status', '$bio')";
		}

		$result = mysqli_query($conn, $sqlinsert);
	}*/
}
?>

<!DOCTYPE html>
	<html>
		<head>
			<title>soapbox - confirmation</title>
		</head>
			<br>
			<?php 
                            $username = $_POST['username'];
                            $email = $_POST['email'];

                            $format = "The data provided has been sent to the server and is being inserted into the database. In order to complete the process, %s, we need you to confirm your account. If not confirmed, your account will be deleted a month from the marked registration date. We have sent you an email at %s, the provided email upon registration. Thank you and cheers! - The Staff at Soapbox";

			    echo sprintf($format, $username, $email);

			    // send email to user with verification key
				session_destroy();
			?>
		</body>
	</html>
