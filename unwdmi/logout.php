<?php
/*
	Logout.php
	handles logout.
*/
	include('include.php');
	session_destroy();
	header("Location: login.php");

?>