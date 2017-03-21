<?php
	// Clear the variables.
	$_SESSION = array(); 
	// Destroy the session itself.
	session_destroy();
	// Destroy the cookie.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0);
	header('Location: /markweb/login.php');
?>