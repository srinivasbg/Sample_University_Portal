<?php
session_start();
$chkid=$_SESSION['myusername'];
$sn1=$_SESSION['sname'];
$dpt=$_SESSION['deptname'];
$con = mysql_connect("localhost","root",""); 
if (!$con) 
{ 
die('Could not connect: ' . mysql_error()); 
}

mysql_select_db("univ2", $con);
$result = mysql_query("SELECT * FROM student where studentid=$chkid"); 
while($row = mysql_fetch_array( $result )) 
{ 
$name=$row['name'];

}
echo "<font size=4>Welcome  ".$name.',';
echo "$chkid";
echo "<br>";
echo "Dept=".$dpt.",";
echo "  Specialization=".$sn1;
if (isset($_POST['Submit1']))
{
$result = mysql_query("select password from student where studentid=$chkid");
if(!$result)
{
	echo "<br>";
	echo "oops! The Username you entered does not exist";
}
else
if($_POST['password']!= mysql_result($result, 0))
{
	echo "<br>";
	echo "You entered an incorrect password";
}
else if($_POST['newpassword']!=$_POST['confirmnewpasssword'])
{
	echo "<br>";
	echo "The new password and confirm new password fields must be the same";
}
else
{
$p=$_POST['newpassword'];
$sql=mysql_query("UPDATE student SET password='$p' where studentid='$chkid'");
}
if($sql)
{
	echo "<br>";
	echo "Congratulations You have successfully changed your password";
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Change Password</title>
<a href="logout.php">Sign Out</a>
<style type="text/css">
.style1 {
	text-align: left;
}
.style2 {
	text-align: left;
	font-size: x-large;
}
.style3 {
	text-align: center;
	font-size: x-large;
}
</style>
</head>

<body style="background-image: url('website_background_1.jpg')">

<p class="style1">&nbsp;</p>
<p class="style1">&nbsp;</p>
<p class="style3">User Accounts</p>

<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; ">
<span class="Apple-style-span" style="font-family: Arial, sans-serif; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; ">
<b><font color="#333333">Change password</font></b><hr style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; background-color: rgb(221, 221, 221); height: 1px; width: 1092px; text-align: left; margin-top: 5px; margin-right: 5px; margin-bottom: 5px; margin-left: 5px; ">
</span></span><br class="Apple-interchange-newline">
<form action="<?php echo $PHP_SELF?>" method="post" style="height: 204px; width: 521px">
	<p class="style2" style="height: 37px">
	<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; ">
	<span class="Apple-style-span" style="font-family: Arial, sans-serif; font-size: small; white-space: nowrap; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; ">
	Current password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</span></span><input name="password" type="password"></p>
	<p class="style2" style="height: 37px">
	<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; ">
	<span class="Apple-style-span" style="font-family: Arial, sans-serif; font-size: small; white-space: nowrap; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; ">
	New password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><input name="newpassword" type="password"></p>
	<p class="style2" style="height: 37px">
	<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; ">
	<span class="Apple-style-span" style="font-family: Arial, sans-serif; font-size: small; white-space: nowrap; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; ">
	Confirm new password:&nbsp;&nbsp;&nbsp; </span></span>
	<input name="confirmnewpasssword" type="password"></p>
	<p class="style2" style="height: 37px">
	<input name="Submit1" type="submit" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="Reset1" type="reset" value="Reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="Submit2" type="button" value="Go Back" onclick=" location.assign( 'account.php' );"></p>
</form>

</body>

</html>
