<?php
/*
check.php
validates login
*/
	include('include.php');
	
	if(isset($_POST['submit'])){
	
		$name = $_POST['name'];
		$pass = md5($_POST['password']);
		
		$query = mysql_query("SELECT * FROM users WHERE name = '".$_POST['name']."' and password = '".$pass."'") or die (mysql_error());
		$result = mysql_fetch_assoc($query);
		
		if(($result['name'])) {
			$_SESSION['name'] = $result['name'];
			$_SESSION['pass'] = $result['password'];
			
			header("Location: index.php");
		}
		else
			header("Location: login.php?login=0");
	}
	
?>