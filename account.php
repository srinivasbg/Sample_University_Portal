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
$result = mysql_query("SELECT stu.studentid,stu.name,stu.address,stu.deptname,stu.email,spec.sname
					  from student stu,specialization spec
					  where stu.studentid=spec.stid and studentid=$chkid"); //retrieve the student details from the student table
while($row = mysql_fetch_array( $result )) 
{ 
$uid=$row['studentid'];//storing all the retrieved values into temporary variables
$name=$row['name'];
$address=$row['address'];
$email=$row['email'];
$sname=$row['sname'];
$deptname=$row['deptname'];
}
echo "<font size=4>Welcome  ".$name.',';
echo "$chkid";
echo "<br>";
echo "Dept=".$dpt.",";
echo "  Specialization=".$sn1;
if (isset($_POST['submit']))
{
$n = trim($_POST["name"]);//get the details the user has changed the values
$a = trim($_POST["address"]);  	
$e = trim($_POST["em"]); 
mysql_select_db("univ2", $con);	
//update the values into the database using the update query
$sql="UPDATE student 	
SET name='$n', address='$a', email='$e' 
WHERE studentid ='$chkid'";	
	if (!mysql_query($sql,$con)) 
	{
	die('Error: ' . mysql_error()); 
	} 
	else 
	{ 
	echo "<br>";
	echo "Updated successfully!"; 	
	echo "<META HTTP-EQUIV=\"refresh\" content=\"2\">";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="en-us" http-equiv="Content-Language">

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Account Information</title>
<style type="text/css">
.style1 {
	margin-left: 160px;
	color: #0000FF;
}
.newStyle1 {
	color: #0000FF;
	background-color: #FFFFFF;
}
.newStyle2 {
	color: #0000FF;
}
.style4 {
	margin-left: 680px;
}
.newStyle3 {
}
.style5 {
	border: thick solid #0000FF;
	font-size: large;
	text-transform: capitalize;
	margin-left: 200px;
	padding: -100px;
}
.style6 {
	font-size: x-large;
}
</style>
</head>
<body style="background-image: url('website_background_1.jpg')">
<hr class="newStyle1" style="height: 10">

<p class="style4">
<a href="logout.php">Sign Out</a>
<body style="background-image: url('website_background_1.jpg')">
</p>
</body>
<p class="style5" style="width: 246px; height: 32px;">&nbsp;<strong><span class="style6">Account 
Settings</span></strong></p>
<form action="<?php echo $PHP_SELF?>" method="post">
<p class="style1">&nbsp;</p>
<p class="style1">&nbsp;User ID: <label id="Label1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
<input name="Text1" type="text" disabled="disabled" value=<?php echo $uid; ?>><br><br>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="name" type="text" value=<?php echo $name; ?>>&nbsp; </p>
	<p class="style1">Department:&nbsp;&nbsp;
	<input disabled="disabled" name="Text2" type="text" value="<?php echo $deptname; ?>"></p>
	<p class="style1">Specialization:
	<input disabled="disabled" name="Text3" type="text" value="<?php echo $sname; ?>"></p>
<p class="style1">Address&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; &nbsp; <textarea cols="20" name="address" style="height: 76px"><?php echo $address; ?></textarea> </p>
<p class="style1">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="em" style="width: 143px" type="text" value="<?php echo $email; ?>" size="25"></p>
<p class="style1">
<input name="submit" type="submit" value="Update Information">
<input name="Submit2" type="button" value="Go Back" onclick=" location.assign( 'login_success.php' );">
<br>
<a href="pass.php">Change Password</a>
<br>
<a href="cc.php">Credit Card Information</a>

</form>

</p>
<p class="style1">
</p>
<p class="style1">&nbsp;</p>
</body>
</html>

