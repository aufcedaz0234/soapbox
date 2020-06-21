<?php
include('header.php');
include('functions.php');
require('dbcon/dbcon.php');

$helperFunctionsClass = new helperFunctions();
$helperFunctionsClass->isLoggedIn();

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>soapbox - account settings</title>
</head>
<body>
	<h2>Account Settings</h2>
	<p>Here you can change your bio, avatar, email address, and reset your password.</p>

	<form action="account_settings.php" method="POST" enctype="multipart/form-data">
			<p>Update Avatar: </p><input type="file" name="avatarFile" id="fileToUpload">

			<p>Username: <?php echo $username;?></p>
			
			<p>Reset Password: </p><input type="password" name="reset-password" placeholder="Password"><br>
			<p>Reset Password (Confirm): </p><input type="password" name="reset-password-confirm" placeholder="Password (Confirm)"><br>
			
			<p>Update Email Address: </p><input type="email_" name="email_address" placeholder="Email Address">
			<p>Update Email Address (Confirm): </p><input type="email" name="email_address_confirm" placeholder="Email Address (Confirm)"><br>

			<p>Bio: </p><textarea name="bio-textarea-update" placeholder="Bio..." rows="5" style="resize: none;"></textarea>
			
			<br><input type="submit" name="submit" value="Submit">
		</form>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// file upload stuff...
	$file = $_FILES['avatar'];
	$fileName = $_FILES['avatar']['name'];
	$fileTmpName = $_FILES['avatar']['tmp_name'];
	$fileSize = $_FILES['avatar']['size'];
	$fileError = $_FILES['avatar']['error'];
	$fileType = $_FILES['avatar']['type'];
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png');
        $suser = $_SESSION['username'];

	if (isset($_FILES['avatar'])) {
		// avatar file constraints checks...
		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 5000000) {
					$fileNameNew = uniqid($_SESSION['username'], true) . "." . $fileActualExt;
					$fileDestination = 'uploads/' . $fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);

					$sql = $pdo->prepare("UPDATE profiles001 SET avatar = '$fileDestination' WHERE username = :suser");
                                        $sql->bindValue(':suser', $suser);
                                        $sql->execute();					
				} else {
					echo "Your file is too big!";
				}
			} else {
				echo "There was an error uploading your file" . $fileError . $fileSize;
			}
		} else if (!empty(in_array($fileActualExt, $allowed)) && !$allowed) {
			echo "Cannot upload file of this type!";
		}
	}

	// bio stuff...
	$bio = $_POST['bio-textarea-update'];

	if (!empty($bio)) {
		$sql =  $pdo->prepare("UPDATE profiles001 SET bio = :bio  WHERE username = :suser");
                $sql->bindValue(':bio', $bio);
		$sql->bindValue(':suser', $suser);
                $sql->execute();
		header('Location: /account_settings.php?success');
	}

	// email stuff...
	$email_address = $_POST['email_address'];
	$email_address_confirm = $_POST['email_address_confirm'];

	if (!empty($email_address) && !empty($email_address_confirm)) {
		$sql = $pdo->prepare("UPDATE profiles001 SET email = :email WHERE username = :suser");
                $sql->bindValue(':email', $email_address_confirm);
                $sql->bindValue(':suser', $suser);
                $sql->execute();
		header('Location: /account_settings.php?success');
	} else {
		echo "Email Address is empty!";
	}
	// TODO: add password reset functionality later.
}
?>
