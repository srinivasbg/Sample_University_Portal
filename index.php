
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>University Login Page</title>
	</head>
	<body bgcolor="#72514e;" style="background-image: url('website_background_1.jpg')">
	<form action="checklogin.php" method="post" accept-charset="utf-8">
	<h1 align=center><font color="#400000"> Welcome to the University Portal</font></h1>
	<div>
	<font size="5">	 
	<b><strong>STUDENT LOGIN:</strong></b>
	<table width="300" border="1" bordercolor="#000080">
		<tr>
		<td width="78">Student ID</td>
		<td width="6">:</td>
		<td width="294"><input name="studentid" type="text" id="studentid"></td>
		</tr>
		<tr>
		<td>Password</td>
		<td>:</td>
		<td><input name="password" type="password" id="password"></td>
		</tr> 
	</table>
	</font>
	</div>
	<p><input type="submit" value="Log In" /></p>
	<?php
	if ($_GET['IncorrectLogin']) // result returned from checklogin.php 
		{
			print("Login Incorrect - please try again");
		}
	?>
	<a href="new.html">Instructors Click Here</a>
</form>

	</body>
</html>
