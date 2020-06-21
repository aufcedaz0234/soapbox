<?php

// mail.php - create email post-registration and send it to specified email address.

$to = $email;
$subject = "SOAPBOX ACCOUNT REGISTRATION VERIFICATION";
$message = "<a href='/verify.php?verification_key=$verification_key'>";
$headers = "From: ";

?>
