<?php

// mail.php - create email post-registration and send it to specified email address.
class mailVerification() {
    $subject = "SOAPBOX ACCOUNT REGISTRATION VERIFICATION";
    $message = "<a href='/verify.php?verification_key=$verification_key'>";
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";

    public function sendVerificationEmail($to) {
        mail($to, $subject, $message, [$headers]); 
    }

}
?>
