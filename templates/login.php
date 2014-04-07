<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<center>
			<form method="post" action="">
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" name="user" autocomplete="off" /></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="pass" /></td>
					</tr>
					<tr>
						<td><input type="submit" name="login" value="Login"/></td>
					</tr>
				</table>
			</form>
			
			<?php if (session::exists('error')) echo session::flash('error'); ?>
		
		</center>
	</body>
</html>