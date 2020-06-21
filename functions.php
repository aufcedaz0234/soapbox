<?php
// Functions are stored here
// Any code that is repeated more than once is put into a function to make my life easier
// The start of going from procedural to OOP

// checks if user is logged in or not, limits access to certain pages in/on site.
class helperFunctions {

function sanitizeData($data) {
	strip_tags($data);
	trim($data);
	//return $data;
}

function isLoggedIn() {
	if (!(isset($_SESSION['logged_in_user']))) {
		header('Location: /index.php');
	}
}

function thumbnailImage() {
		$thumbnailImageFile = $_FILES['thumbnailImage'];
		$thumbnailImageName = $_FILES['thumbnailImage']['name'];
		$thumbnailImageTmpName = $_FILES['thumbnailImage']['tmp_name'];
		$thumbnailImageSize = $_FILES['thumbnailImage']['size'];
		$thumbnailImageError = $_FILES['thumbnailImage']['error'];
		$thumbnailImageType = $_FILES['thumbnailImage']['type'];
		$thumbnailImageExt = explode('.', $thumbnailImageName);
		$thumbnailImageActualExt = strtolower(end($thumbnailImageExt));

		$allowedThumbnailFileExts = array('png', 'jpg', 'jpeg');

		if (isset($_FILES['thumbnailImage'])) {
			if (in_array($thumbnailImageActualExt, $allowedThumbnailFileExts)) {
				if ($thumbnailImageError === 0) {
					if ($thumbnailImageSize < 200000000) {
						$thumbnailImageNameNew = $username . "thumbnailImage" . uniqid('', true). "." . $thumbnailImageActualExt;
						$thumbnailImageDestination = 'uploads/thumbnails/' . $thumbnailImageNameNew;
						move_uploaded_file($thumbnailImageTmpName, $thumbnailImageDestination);
					} else {
						echo "Your file is too big!";
					}
				} else {
					echo "There was an error uploading your file" . $thumbnailImageError . $thumbnailImageSize;
				}
			} else if (!$allowed) {
				echo "Cannot upload file of this type!";
			}
		} else {
			echo "Empty thumbnail file";
		}
}
} // end of class
?>
