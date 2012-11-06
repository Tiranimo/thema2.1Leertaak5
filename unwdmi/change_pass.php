<?php
	include('include.php');
	include('session.php');
	
	
	if(isset($_POST['submit'])){
		$pass = md5($_POST['password']);
		$newPass = md5($_POST['new_password']);
		$repPass = md5($_POST['repeat_password']);
		
		$query = mysql_query("SELECT * FROM users WHERE name = '".$_SESSION['name']."' AND password = '".$pass."'") or die (mysql_error());
		$result = mysql_fetch_assoc($query);
		
		if($result['password'] == $pass && $newPass == $repPass) {
			mysql_query("UPDATE users SET password = '".$newPass."' WHERE name = '".$_SESSION['name']."'") or die (mysql_error());
			$_SESSION['pass'] = $newPass;
			$message =  '<div class="message-correct">password changed!</div>';
		}
		else
			$message = '<div class="message-error">change password failed, try again.</div>';
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Andong College’s Research Institute of the Pacific</title>
	<link rel="stylesheet" href="default.css" type="text/css" />
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="logo">
			</div>
			<div class="welcome">	
				Welcome <?php echo $_SESSION['name']; ?>.
			</div>
			<div class="menu">
				<ul>
					<li class="first"><a href="index.php">Home</a></li>
					<li><a href="#">Download CSV</a></li>
					<li><a href="change_pass.php">Change Password</a></li>
					<li class="last"><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div><!--end header-->
		<div class="content">
		<div class="change_pass">
			
				<?php if(isset($message)) echo $message; ?>
			
			<h2>CHANGE PASSWORD</h2>
			<form method="post" action="" >
				<table>
					<tr>
						<td>Current Password</td><td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td>New Password</td><td><input type="password" name="new_password" /></td>
					</tr>
					<tr>
						<td>Repeat New Password</td><td><input type="password" name="repeat_password" /></td>
					</tr>
					<tr>
						<td></td><td><input class="button" type="submit" name="submit" value="Change Password" /></td>
					</tr>
				</table>
			</form>
			
		</div>
		</div><!--end content-->
		<div class="clear">
		</div>
	</div><!--end wrapper-->
		<div class="footer">
			<span>Designed & Created by: JCorp</span>
		</div><!--end footer-->
	
</body>
</html>