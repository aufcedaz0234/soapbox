<?php
include('header.php');
include('createUser.php');
require('dbcon/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('libs/PHPMailer/src/Exception.php');
require('libs/PHPMailer/src/PHPMailer.php');
require('libs/PHPMailer/src/SMTP.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $createUser = new createUser();
    $createUser->addUser($pdo);

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // server settings
	$mail->SMTPDebug  = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host       = '0xfdb.xyz';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'soapbox';
	$mail->Password   = 'xWDi7SnEEU';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port       = 25;

	$mail->setFrom('admin+soapbox@0xfdb.xyz');
	$mail->addAddress('dalvarez1999@protonmail.com');
	$mail->isHTML(true);
	$mail->Subject  = 'SOAPBOX';
	$mail->Body     = 'Please confirm your account by clicking on the link below. n\
                           https://soapbox.0xfdb.xyz/confirmation.php?verification_key=';

	$mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mail error: {$mail->ErrorInfo}";
    }
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
			    $query = $pdo->prepare("SELECT verification_key from profiles001 WHERE username = :username");
			    $query->bindValue(':username', $username);
			    $query->execute();

			    $row = $query->fetch(PDO::FETCH_ASSOC);
                            $verification_key = $row['verification_key'];

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // server settings
	$mail->SMTPDebug  = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host       = '0xfdb.xyz';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'soapbox';
	$mail->Password   = 'xWDi7SnEEU';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port       = 25;

	$mail->setFrom('admin+soapbox@0xfdb.xyz');
	$mail->addAddress($email);
	$mail->isHTML(true);
	$mail->Subject  = 'SOAPBOX';
	$mail->Body     = 'Please confirm your account by clicking on the link below. n\
                           https://soapbox.0xfdb.xyz/confirmation.php?verification_key=' . $verification_key;

	//$mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mail error: {$mail->ErrorInfo}";
    }
                            $format = "The data provided has been sent to the server and is being inserted into the database. In order to complete the process, %s, we need you to confirm your account. If not confirmed, your account will be deleted a month from the marked registration date. We have sent you an email at %s, the provided email upon registration. Please make sure to check your spam folder. Thank you and cheers! - The Staff at Soapbox";

			    echo sprintf($format, $username, $email);
                            $mail->send();
			    // send email to user with verification key
				session_destroy();
			?>
		</body>
	</html>
