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
</style>
</head>

<body style="background-image: url('website_background_1.jpg')">

<p class="style2"><strong>STUDENT UNIVERSITY PAGE </strong></p>
<p class="style3">Check Current Standing</p>
<p class="style1">&nbsp;</p>
<div align="center">

<?php
/** this part of the code retrieves the courses that a student has completed **/
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("univ2", $con);
/** The following query joins enrollment and section table to get the sections offered with the respective section information
 and then seeing what courses a student has got a grade using his student id.The table is again joined with the course table to get the course name **/ 
$result1 = mysql_query("SELECT en.studentid,s.cno,c.cname,s.secno,en.grade,en.gradeunits,s.sem
from
enrollment en left outer join section s on s.secno=en.secno
left outer join courses c on c.cno=s.cno
where en.grade != 'In Progress' and en.studentid=$chkid");
if(!$result1) die(mysql_error());
echo "<table border='1'>
<CAPTION><EM>Courses Completed</EM></CAPTION>
<tr>
<th>Student Id</th>
<th>Course No.</th>
<th>Course Name</th>
<th>Section No.</th>
<th>Grade</th>
<th>GradeUnits Earned</th>
<th>Semester</th>
</tr>";
$num_rows = mysql_num_rows($result1);
if($num_rows==0)
{
  echo "<tr>";
  echo "<td>No Information Availiable </td>";
  echo "</tr>";
}
else
{
while($row=mysql_fetch_array($result1))
  {
  echo "<tr>";
  echo "<td>" . $row[0] . "</td>";
  echo "<td>" . $row[1] . "</td>";
  echo "<td>" . $row[2] . "</td>";
  echo "<td>" . $row[3] . "</td>";
  echo "<td>" . $row[4] . "</td>";
  echo "<td>" . $row[5] . "</td>";
  echo "<td>" . $row[6] . "</td>";
  echo "</tr>";
  }
}  
echo "</table>";

mysql_close($con);
?> 

<?php 
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("univ2", $con);
$result1 = mysql_query("SELECT (sum(en.gradeunits)/count(distinct c.cno)) as OverallGPA
from
enrollment en left outer join section s on s.secno=en.secno
left outer join courses c on c.cno=s.cno
where en.grade != 'In Progress' and en.studentid=$chkid");
if(!$result1) die(mysql_error());
while($row=mysql_fetch_array($result1))
{
echo "<br>";
echo "<b>OverallGPA=$row[0]</b>";
}
echo "<br>";
echo "<br>";
?>

<?php
/*The following query joins enrollment and section table to get the sections offered with the respective section information
 and then seeing what courses a student has not got a grade using his student id and is not in waitlist.The table is again joined with the course table to get the course name */
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("univ2", $con);
$result1 = mysql_query("SELECT en.studentid,s.cno,c.cname,s.secno,en.grade,en.gradeunits,s.sem
from
enrollment en left outer join section s on s.secno=en.secno
left outer join courses c on c.cno=s.cno
where en.grade = 'In Progress' and en.studentid=$chkid and en.waitno=0");
if(!$result1) die(mysql_error());
echo "<table border='1'>
<CAPTION><EM>Courses Enrolled</EM></CAPTION>
<tr>
<th>Student Id</th>
<th>Course No.</th>
<th>Course Name</th>
<th>Section No.</th>
<th>Grade</th>
<th>GradeUnits Earned</th>
<th>Semester</th>
</tr>";
$num_rows = mysql_num_rows($result1);
if($num_rows==0)
{
  echo "<tr>";
  echo "<td>No Information Availiable </td>";
  echo "</tr>";
}
else
{
while($row=mysql_fetch_array($result1))
  {
  echo "<tr>";
  echo "<td>" . $row[0] . "</td>";
  echo "<td>" . $row[1] . "</td>";
  echo "<td>" . $row[2] . "</td>";
  echo "<td>" . $row[3] . "</td>";
  echo "<td>" . $row[4] . "</td>";
  echo "<td>" . $row[5] . "</td>";
  echo "<td>" . $row[6] . "</td>";
  echo "</tr>";
  }
}  
echo "</table>";
echo "<br>";

mysql_close($con);
?> 

<?php
/*The following query joins enrollment and section table to get the sections offered with the respective section information
 and then seeing what courses a student has not got a grade using his student id and is in waitlist.The table is again joined with the course table to get the course name */
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("univ2", $con);
$result1 = mysql_query("SELECT en.studentid,s.cno,c.cname,s.secno,en.grade,en.gradeunits,s.sem
from
enrollment en left outer join section s on s.secno=en.secno
left outer join courses c on c.cno=s.cno
where en.grade = 'In Progress' and en.studentid=$chkid and en.waitno!=0");
if(!$result1) die(mysql_error());
echo "<table border='1'>
<CAPTION><EM>Courses WaitListed</EM></CAPTION>
<tr>
<th>Student Id</th>
<th>Course No.</th>
<th>Course Name</th>
<th>Section No.</th>
<th>Grade</th>
<th>GradeUnits Earned</th>
<th>Semester</th>
</tr>";
$num_rows = mysql_num_rows($result1);
if($num_rows==0)
{
  echo "<tr>";
  echo "<td>No Information Availiable </td>";
  echo "</tr>";
}
else
{
while($row=mysql_fetch_array($result1))
  {
  echo "<tr>";
  echo "<td>" . $row[0] . "</td>";
  echo "<td>" . $row[1] . "</td>";
  echo "<td>" . $row[2] . "</td>";
  echo "<td>" . $row[3] . "</td>";
  echo "<td>" . $row[4] . "</td>";
  echo "<td>" . $row[5] . "</td>";
  echo "<td>" . $row[6] . "</td>";
  echo "</tr>";
  }
}  
echo "</table>";

mysql_close($con);
?> 

<br></br>
<input name="Submit2" type="button" value="Go Back" onclick=" location.assign( 'login_success.php' );">
</div>

<br>
</br>
	

</body>

</html>
