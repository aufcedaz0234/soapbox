<?php 

require('dbcon/dbcon.php');

class fileUpload {
    
    // file uplods occur here
    // user submits file(s)

	public function processFile() { /* checks file extension */
		$permittedExtensions = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		$fileName = $_FILES["avatar"]["name"];
		$ext = pathinfo($fileName, PATHINFO_EXTENSION);

               // if (!array_key_exists($ext, $permittedExtensions)) die ("Error: Please select a valid file format.");
		$fileSize = $_FILES["avatar"]["size"];
                $maxSize = 5 * 1024 * 1024;

		if ($fileSize > $maxSize) die("File size is greater than the allotted 5MB limit.");

	    $filetype = $_FILES["avatar"]["type"];
		if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
			if (in_array($filetype, $permittedExtensions)) {
				if (file_exists("/soapbox/uploads/" . $fileName)) {
				 echo $fileName . " already exists.";
				} else {
				    move_uploaded_file($_FILES["avatar"]["tmp_name"], "/var/www/html/soapbox/uploads/" . $fileName);
				    echo "File has been uploaded successfully.";
				}
			} else {
			    echo "Error: There was a problem in uploading your file. Please try again.";
			}
		} else {
		    echo "Error: " . $_FILES["avatar"]["error"];
		}

	} // end of function
}
?>
