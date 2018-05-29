<?php
session_start();
$chkid=$_SESSION['myusername'];
$sn1=$_SESSION['sname'];
$dpt=$_SESSION['deptname'];
$selection=$_SESSION['selection'];
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

$result1 = mysql_query("SELECT * from credit where studentid=$chkid and ccno='$selection'"); 
while($row = mysql_fetch_array( $result1 )) 
{ 
$name1=$row['name'];
$address=$row['address'];
$ccno=$row['ccno'];
}
echo "<font size=4>Welcome  ".$name.',';
echo "$chkid";
echo "<br>";
echo "Dept=".$dpt.",";
echo "  Specialization=".$sn1;

if (isset($_POST['submit'])) //If submit is hit
{
  
   //convert all the posts to variables:
   $name2 = trim($_POST['name1']);
   $address = trim($_POST['address']);
   $ccno = trim($_POST['ccno']);
   $sql="UPDATE credit SET name='$name2', address='$address', ccno='$ccno' WHERE studentid ='$chkid' and ccno='$selection'";
   if (!mysql_query($sql,$con))
 	 {
  		die('Error: ' . mysql_error());
  	}
	
	mysql_close($con); 
echo "<br>";
echo "Record Updated";

    
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Update Credit Card</title>
<style type="text/css">
.style1 {
	margin-left: 320px;
}
.style2 {
	font-size: large;
}
.style3 {
	margin-left: 40px;
	text-align: left;
}
.style4 {
	font-size: x-large;
}
</style>
<a href="logout.php">Sign Out</a>
</head>

<body style="background-image: url('website_background_1.jpg')">
<br>
<div align="center" class="style2">

	<p class="style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span class="style4"><strong>Edit Your Card Details</strong></span></p>

</div>
<form action="<?php echo $PHP_SELF?>" method="post">

	<p class="style1">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	
	<input name="name1" type="text" value="<?php echo $name1; ?>"></p>
	<p class="style1">Credit Card No.&nbsp; 
	<input name="ccno" type="text" value="<?php echo $ccno; ?>"></p>
	<p class="style1">Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="address" type="text" value="<?php echo $address; ?>"></p>
	<p class="style1"><input name="submit" type="submit" value="Update">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="Submit2" type="button" value="Go Back" onclick=" location.assign( 'cc.php' );">
	</p>

</form>
</body>

</html>
