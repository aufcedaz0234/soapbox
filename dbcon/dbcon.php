<?php
$host   = "localhost";
$database = "soapbox";
$username = "root";
$password = "m1n3craft";

// Create connection
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=soapbox;', $username, $password);
    } catch (PDOExcpetion $e) {
	    print "Error!: " . $e.getMessage() . "<br/>";
	    die();
    }
/*

Print error message and or code to the screen if there is an error.

*/

?>
