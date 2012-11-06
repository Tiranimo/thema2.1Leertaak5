<?php

/*
session.php
this file handles the login
*/
if(!isset($_SESSION['name']) && !isset($_SESSION['pass']))
{
	header("Location: login.php");
}

$name = $_SESSION['name'];
$pass = $_SESSION['pass'];

$query = mysql_query("SELECT * FROM users WHERE name = '".$name."' and password = '".$pass."'") or die (mysql_error());

$result = mysql_fetch_assoc($query);

if($result['name'] != $name || $result['password'] != $pass)
	header("Location: login.php");

?>