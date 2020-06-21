<?php
require("dbcon/dbcon.php");

class User {

	// this class contains user information
	// return user password and username
        public function getUserCredentials($pdo, $username) {
            $query = $pdo->prepare("SELECT username, password FROM profiles001 WHERE username = :username");
	    $query->bindValue(':username', $username);
	    $query->execute();

	    $result = $query->fetch(PDO::FETCH_ASSOC);

	    return $result;
        }
}
?>
