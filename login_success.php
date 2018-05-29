<?php 
session_start();
$chkid=$_SESSION['myusername'];//retrieve the session of the user
$con = mysql_connect("localhost","root",""); 
if (!$con) 
	{ 
		die('Could not connect: ' . mysql_error()); 
	}
mysql_select_db("univ2", $con);
$result = mysql_query("SELECT * FROM student where studentid=$chkid"); //retrieve the student name
while($row = mysql_fetch_array( $result )) 
	{ 
		$name=$row['name'];
	}
$result1 = mysql_query("SELECT stu.studentid,stu.name,stu.address,stu.deptname,stu.email,spec.sname
					  from student stu,specialization spec
					  where stu.studentid=spec.stid and studentid=$chkid"); //retrieve the student details from the student table
while($row = mysql_fetch_array( $result1 )) 
{ 
$uid=$row['studentid'];//storing all the retrieved values into temporary variables
$sname=$row['sname'];
$deptname=$row['deptname'];
$_SESSION['sname']=$sname;
$_SESSION['deptname']=$deptname;
}
echo "Welcome ".$name.',';
echo "$chkid";
echo "<br>";
echo "Dept=".$deptname.",";
echo "  Specialization=".$sname;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>UNIVERSITY PORTAL STUDENT HOMEPAGE</title>
<script type="text/javascript">
function newwindow()
{
  window.open ('Account.php')
}
</script>
<style type="text/css">
#button1 {
	     color:red;
	     background:white;
	 }
	 #button2 {
	 	 color:white;
	 	 background:red;
	 }
.style1 {
	margin-left: 280px;
	background-color: #C0CCF1;
}
.style3 {
	text-align: center;
	margin-left: 360px;
	background-color: #C0CCF1;
}
.style4 {
	text-align: right;
	background-color: #C0CCF1;
}
.style5 {
	background-color: #C0CCF1;
}
.style6 {
	color: #1D23F3;
	background-color: #C0CCF1;
}
</style>
</head>
<div class="style4">
	<a href="logout.php">Sign Out</a>
<body bgcolor="#C0C0C0" style="background-image: url('website_background_1.jpg')">
	</div>
<p align="center" class="style1" style="width: 350px; height: 38px;">
<span class="style5">
UNIVERSITY PORTAL STUDENT HOMEPAGE</span><br />
	</p>
<p class="style3" style="width: 154px">Choose Your Option&nbsp;&nbsp;&nbsp; </p>
<form method="post" class="style5" style="height: 187px">
	<br />
	<br />
	<input class="style6" name="Button1" style="height: 92px; width: 145px" type="button" value="Manage Your Account"  ondblclick="newwindow()" onclick=" location.assign( 'account.php' );" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="style6" name="Button2" style="height: 92px; width: 145px" type="button" value="Grades" onclick=" location.assign( 'grade.php' );" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="style6" name="Button3" style="height: 92px; width: 145px" type="button" value="Enrollment" onclick=" location.assign( 'enrollment.php' );" /></form>
</body>
</html>
