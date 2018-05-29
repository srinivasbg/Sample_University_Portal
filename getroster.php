<?php session_start();?>
<html>
<head>
</head>
<body background="lightblue.jpg">
<?php 
$IID=$_SESSION['IID'];
$sem=$_GET['sem'];
$secno=$_GET['secno'];
$host="localhost";
$user="root";
$password="";
$dbname="univ2";
$link=mysql_connect($host,$user,$password);
if($_GET['sem']!='f09')
{
/* The following query takes the student id from enrollment where the section number in enrollment is present in section table for that particular semester and the semester is not fall 09*/
$query1="select studentid from enrollment where secno in (select secno from section where secno='".$_GET['secno']."' AND sem='".$_GET['sem']."')";
$cuser1=mysql_db_query($dbname,$query1,$link)or die('Select error first query'.mysql_error());
$no1=mysql_num_rows($cuser1);
$i=0;
?>
<p>Details of student:</p>
<table width="100%" cellpadding="5" border="1" cellspacing="5">
<tr>
<th>Student ID</th>
<th>Student Name</th>
<th>DeptName</th>
<th>Specialization</th>
<th>Grade</th>
</tr>
<?php 
while($r2=mysql_fetch_array($cuser1))
	{
	$query2="select name,deptname from student where studentid='".$r2['studentid']."'";//select name of student and department name for a particular student
	$cuser2=mysql_db_query($dbname,$query2,$link)or die('Select error'.mysql_error());
	$r3=mysql_fetch_array($cuser2);
	$query3="select sname from specialization where stid='".$r2['studentid']."'";//select specialization took by a particular student
	$cuser3=mysql_db_query($dbname,$query3,$link)or die('Select error'.mysql_error());
	$r4=mysql_fetch_array($cuser3);
	$query5="select grade from enrollment where studentid='".$r2['studentid']."' AND secno='".$secno."'";//selects the grade if any updated by professor from enrollment table
	$cuser5=mysql_db_query($dbname,$query5,$link)or die('Select error'.mysql_error());
	$r5=mysql_fetch_array($cuser5);
	?>
<tr>
<td><?php echo $r2['studentid']?>
<td><?php echo $r3['name']?>
<td><?php echo $r3['deptname']?>	
<td><?php echo $r4['sname']?>
<td><?php echo $r5['grade']?>
</tr>
	<?php
}
}
else
{
/* The following query selects student id from enrollment for the section present in section table that has semester as fall 09 and allow the people to update the grade */
$query1="select studentid from enrollment where secno in (select secno from section where secno='".$_GET['secno']."' AND sem='".$_GET['sem']."')";
$cuser1=mysql_db_query($dbname,$query1,$link)or die('Select error here in else'.mysql_error());
$no1=mysql_num_rows($cuser1);
$i=0;
?>
<p>Details of student:</p>
<table width="100%" cellpadding="5" border="1" cellspacing="5">
<tr>
<th>Student ID</th>
<th>Student Name</th>
<th>DeptName</th>
<th>Specialization</th>
<th>Enter Grade</th>
<th>Click Update</th>
</tr>
<?php 
$i=0;
while($r2=mysql_fetch_array($cuser1))
	{
	$query2="select name,deptname from student where studentid='".$r2['studentid']."'";//select name of student and department name for a particular student
	$cuser2=mysql_db_query($dbname,$query2,$link)or die('Select error'.mysql_error());
	$r3=mysql_fetch_array($cuser2);
	$query3="select sname from specialization where stid='".$r2['studentid']."'";//select specialization took by a particular student
	$cuser3=mysql_db_query($dbname,$query3,$link)or die('Select error'.mysql_error());
	$r4=mysql_fetch_array($cuser3);
	$query5="select grade from enrollment where studentid='".$r2['studentid']."' AND secno='".$secno."'";//selects the grade if any updated by professor from enrollment table
	$cuser5=mysql_db_query($dbname,$query5,$link)or die('Select error'.mysql_error());
	$r5=mysql_fetch_array($cuser5);
	?>
<tr>
<td><?php echo $r2['studentid']?>
<td><?php echo $r3['name']?>
<td><?php echo $r3['deptname']?>	
<td><?php echo $r4['sname']?>
<?php if($r5['grade']=="In Progress" && $sem!='s10')
{
	?>
	<form action="update.php?cno=<?php echo $_GET['cno'];?>&stid=<?php echo $r2['studentid'];?>&i=<?php echo $i;?>&secno=<?php echo $secno?>" method="POST">
<td><input type=text name="<?php echo $i?>"></input>
<td><input type ="submit" value="Click to update grades!!!!"></input></td>
</form>
	<?php 
}
else
{
?>	<td><?php echo $r5['grade']?>
</tr>
	<?php
}
$i++;
}
}
?>
</table>
Click<a href="getdata.php"> here</a> to go back
Click<a href="lout.php">Here</a>to log out <!-- Click to Log out --> 
</body>
</html>