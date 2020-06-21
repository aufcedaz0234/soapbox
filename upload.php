<?php

include('header.php');
require('dbcon/dbcon.php');
include('functions.php');

$helperFunctionsClass = new helperFunctions();
$helperFunctionsClass->isLoggedIn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Error declaration
    $error = ["Your file is too big!", "There was an error uploading your file!", "Cannot upload file of this type!", "Empty fields!"];
    
    $array = [];

    // Process POST variables
    $videoTitle = $_POST['video_title'];
    $videoDesc = $_POST['textarea-videoDesc'];

    // Process session variable
    $username = $_SESSION['username'];
		
    // file upload stuff...
    $file = $_FILES['videoFile'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('mp4', 'mov', 'mkv', 'mp3');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 20 * 1024 * 1024) {
		    $fileNameNew = $username . "." . $fileActualExt;
		   // mkdir("channel/" . $username . "/videos/");
                $fileDestination = "uploads/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo $error[0];
            }
        } else {
            echo $error[1];
        }
    } else if (!$allowed) {
        echo $error[2];
    }
////////////////////////////////////////////////////////////////////

			$thumbnailImageFile = $_FILES['thumbnailImage'];
			$thumbnailImageName = $_FILES['thumbnailImage']['name'];
			$thumbnailImageTmpName = $_FILES['thumbnailImage']['tmp_name'];
			$thumbnailImageSize = $_FILES['thumbnailImage']['size'];
			$thumbnailImageError = $_FILES['thumbnailImage']['error'];
			$thumbnailImageType = $_FILES['thumbnailImage']['type'];
			$thumbnailImageExt = explode('.', $thumbnailImageName);
			$thumbnailImageActualExt = strtolower(end($thumbnailImageExt));

			$allowedThumbnailFileExts = array('png', 'jpg', 'jpeg');

			$uploadDate = date("Y-m-d h:i:s");
                        date_default_timezone_set('UTC');

			if (in_array($thumbnailImageActualExt, $allowedThumbnailFileExts)) {
				if ($thumbnailImageError === 0) {
					if ($thumbnailImageSize < 20 * 1024 * 1024) {
						$thumbnailImageNameNew = $username . "thumbnailImage" . "." . $thumbnailImageActualExt;
						$thumbnailImageDestination = 'uploads/thumbnails/' . $thumbnailImageNameNew;
						move_uploaded_file($thumbnailImageTmpName, $thumbnailImageDestination);
					} else {
						echo $error[0];
					}
				} else {
					echo $error[1];
				}
			} else if (!$allowed) {
				echo $error[2];
			}

		if (isset($file) && $fileSize != 0 /*&& $thumbnailImageSize != 0*/ && isset($videoTitle)) {
			$sql = $pdo->prepare("INSERT into videos001 (uploader, upload_date, video, thumbnail, video_title, video_desc) VALUES (:username, :uploadDate, :fileDestination, :thumbnailImageDestination, :videoTitle, :videoDesc)");
			$sql->bindValue(':username', $username);
			$sql->bindValue(':uploadDate', $uploadDate);
                        $sql->bindValue(':fileDestination', $fileDestination);
                        $sql->bindValue(':thumbnailImageDestination', $thumbnailImageDestination);
                        $sql->bindValue(':videoTitle', $videoTitle);
                        $sql->bindValue(':videoDesc', $videoDesc);
                        $sql->execute();

			header('Location: /soapbox/upload.php?success');
		} else {
			echo $error[3];
		}
		
} // end of if server method...

// TODO: if there's no thumbnail, do not upload video, let user know to put in a thumbnail
?>

<!DOCTYPE html>
<html>
<head>
	<title>soapbox - upload</title>
</head>
<body>
	<form action="upload.php" method="POST" enctype="multipart/form-data" multiple><br>
		<p>Video File:</p><input type="file" name="videoFile" id="fileToUpload"><br>
		<p>Thumbnail Image File: </p><input type="file" name="thumbnailImage"><br>
		<p>Video Title: </p><input type="text" name="video_title" id="videoTitle" placeholder="Video title"><br>
		<p>Video Description</p><textarea name="textarea-videoDesc" placeholder="Video description..." rows="7" style="resize: none;"></textarea><br>
		<br><input type="submit" name="uploadBtn" value="Upload">
	</form>
</body>
</html>
