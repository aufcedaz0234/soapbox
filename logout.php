<?php

include('header.php');

if (session_destroy()) {
	header('Location: /index.php');
}
?>
