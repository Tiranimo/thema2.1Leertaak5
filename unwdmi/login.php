

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
	<title>Andong College’s Research Institute of the Pacific</title>
	<link rel="stylesheet" href="default.css" type="text/css" />
</head>
<body>
	<div class="wrapper">
		<div class="login">
			<div class="logo">
			</div>
			<?php 
				if(isset($_GET['login']))
					echo 'incorrect username or password, please try again!';
			?>
			<h2>Login</h2>
			<form action="check.php" method="post">
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" name="name" /></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Login" name="submit" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>