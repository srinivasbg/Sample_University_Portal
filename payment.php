<?php
session_start();
$chkid=$_SESSION['myusername'];
$sno=$_SESSION['val'];
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
$query1="select cno from section where secno=$sno";
$result1=mysql_query($query1);
while($r=mysql_fetch_array($result1))
{
	$cno=$r['cno'];
}


?>
<?php 
$query2="select ccno from credit where studentid=$chkid";
$result2=mysql_query($query2);
$ccno=array();
while($r1=mysql_fetch_array($result2))
{
	
	
	$ccno[]=$r1['ccno'];
	
	
}
if (isset($_POST['Submit1']))
	{
		$e=$_POST['Select1'];
		$quk="insert into payment (amount,ccno,sid,cno) values (1000,$e,$chkid,$cno)";
		$kk=mysql_query($quk);
		if(!$kk) die(mysql_error());
		echo "Payment Successfull";
	}
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Current Standing</title>
<a href="logout.php">Sign Out</a>
<style type="text/css">
.style1 {
	text-align: center;
	margin-left: 200px;
}
.style2 {
	text-align: center;
	font-size: x-large;
	margin-left: 50px;
}
.style3 {
	text-align: center;
	font-size: large;
	margin-left: 70px;
}
.style4 {
	margin-left: 8px;
}
</style>
</head>

<body style="background-image: url('website_background_1.jpg')">

<p class="style2"><strong>STUDENT UNIVERSITY PAGE </strong></p>
<p class="style3">Payment Details</p>
<p class="style1">&nbsp;</p>
<div align="center">

	<form action="<?php echo $PHP_SELF?>" method="post">
		<br><br>Student Id :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input class="style4" name="Text2" style="height: 24px" type="text" value="<?php echo $chkid; ?>"><br>
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Credit Card No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="Select1" id= "msg" style="width: 129px; height: 42px">
		<?php 
		for($i=0; $i < count($ccno); $i++)
  		echo "<option value=". $ccno[$i] .">" . $ccno[$i] . "</option>";
		?>
		</select>&nbsp;<a  href="cc.php" >Add a Card </a> <br><br>Amount(In Dollars)&nbsp;
		<input disabled="disabled" name="Text4" style="width: 128px; height: 23px" type="text" value="1000"><br> 
		<br>Course No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input disabled="disabled" name="Text5" style="width: 131px; height: 23px" type="text" value="<?php echo $cno; ?>"><br>
		<br><br><input name="Submit1" type="submit" value="submit">&nbsp;&nbsp;&nbsp;
		<input name="Submit2" type="button" value="Back" onclick="location.assign( 'enrollment.php' );"></form>
	<br></br>
&nbsp;</div>

<br>
</br>
	

</body>

</html>
