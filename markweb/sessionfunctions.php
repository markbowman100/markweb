<?php
	function startPate() {
		session_start();
		if (!isset($_SESSION['username'])) {
			header('Location: /markweb/login.php');
		}
		include('header.php');
	}
?>