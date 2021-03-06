<?php
require('dbcon/dbcon.php');
include('fileUpload.php');
include('functions.php');

class createUser {

    //public $functionsClassInstance = new helperFunctions();
   // public $mailVerificationClass = "default";

    public $avatar;
    public $bio;
    public $video_count;
    public $c_status;
    public $usernameI;
    public $username;
    public $password;
    public $email;
    public $doc;
    public $last_logged_in;

    public function addUser(PDO $pdo) {
	// add user info to db
	    $avatar = "/assets/soap.jpg";
	    $username = strip_tags(trim($_POST['username']));
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $bio = $_POST['bio'];
            $email = $_POST['email'];
	    $c_status = 0;
            date_default_timezone_set('UTC');
	    $doc = date("Y-m-d h:i:s");
	    // account date last seen/logged in
	    // add account age

	    // generate user verification key for registration
            $verification_key = md5(time().$username);

	    $query = $pdo->prepare("INSERT into profiles001 (username, password, email, c_status, bio, doc, avatar, verification_key) VALUES (:username, :password, :email, :cstat, :bio, :doc, :avatar, :verification_key)");

	    $query->bindValue(':username', $username);
	    $query->bindValue(':password', $password);
	    $query->bindValue(':email', $email);
	    $query->bindValue(':doc', $doc);
	    $query->bindValue(':bio', $bio);
	    $query->bindValue(':cstat', $c_status);
	    $query->bindValue(':avatar', $avatar);
	    $query->bindValue(':verification_key', $verification_key);

	    // if user uploads file, add path and file to database and server, if not revert to default.
            if ($_FILES["avatar"]["error"] == 4) {
		    $query->execute();
	    } elseif ($_FILES["avatar"]["error"] != 4) {
	        $file = new fileUpload();
		$file->processFile();
		$avatar = "/soapbox/uploads/" . $_FILES["avatar"]["name"];
	        $query = $pdo->prepare("INSERT into profiles001 (username, password, email, c_status, bio, doc, avatar, verification_key) VALUES (:username, :password, :email, :cstat, :bio, :doc, :avatar, :verification_key)");
		
		$query->bindValue(':username', $username);
	        $query->bindValue(':password', $password);
	        $query->bindValue(':email', $email);
	        $query->bindValue(':doc', $doc);
	        $query->bindValue(':bio', $bio);
	        $query->bindValue(':cstat', $c_status);
		$query->bindValue(':avatar', $avatar);
		$query->bindValue(':verification_key', $verification_key);
	        $query->execute();
	    }
	    // create variables
	    // initialize variables
	    // bind values of variables being entered into database
       }

}

// this file is responsible for creating the users
?>
