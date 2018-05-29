<?php session_start();?>
<html>
<head>
</head>
<body background="lightblue.jpg">
<?php 
$IID=$_SESSION['IID'];
/*$_GET['i'] gets the row selected in previous page*/
$data=$_GET['i'];
/*$_POST[$data] gets the grade value typed by instructore*/
$d=$_POST[$data];
$secno=$_GET['secno'];
$sem=$_SESSION['sem'];
$host="localhost";
$user="root";
$password="";
$dbname="univ2";
$link=mysql_connect($host,$user,$password);
$query2="update enrollment set grade='".$d."' where secno='".$secno."' AND studentid='".$_GET['stid']."'";//update grade for a particular student
$query1="select studentid,grade from enrollment where secno='".$secno."'";//selects student id and grade to display the updated roster
$cuser1=mysql_db_query($dbname,$query2,$link)or die('Select error'.mysql_error());
$cuser5=mysql_db_query($dbname,$query1,$link)or die('Select error'.mysql_error());
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
while($r2=mysql_fetch_array($cuser5))
	{
	$query2="select name,deptname from student where studentid='".$r2['studentid']."'";//select name of student and department name for a particular student
	$cuser2=mysql_db_query($dbname,$query2,$link)or die('Select error'.mysql_error());
	$r3=mysql_fetch_array($cuser2);
	$query3="select sname from specialization where stid='".$r2['studentid']."'";//select specialization took by a particular student
	$cuser3=mysql_db_query($dbname,$query3,$link)or die('Select error'.mysql_error());
	$r4=mysql_fetch_array($cuser3);
	?>
<tr>
<td><?php echo $r2['studentid']?>
<td><?php echo $r3['name']?>
<td><?php echo $r3['deptname']?>	
<td><?php echo $r4['sname']?>
<?php if($r2['grade']=="In Progress")
{
	/* if the grade is in progress then allow the instructor to update grade */
	?>
<form action="update.php?cno=<?php echo $_GET['cno'];?>&stid=<?php echo $r2['studentid'];?>&i=<?php echo $i;?>&secno=<?php echo $secno?>" method="POST">
<td><input type=text name="<?php echo $i?>"></input>
<input type="hidden" name="sem" value="<?php echo $sem?>"></input>
<td><input type ="submit" value="Click to update grades!!!!"></input></td>
</form><?php 
}
else
{
?>	<td><?php echo $r2['grade']?>
<?php }
?>
</tr>
	<?php
$i++;
	}

?>
</table>
Click<a href="old.php">Here</a>to go select semesters !!!!
Click<a href="lout.php">Here</a>to log out <!-- Click to Log out -->
</body>
</html>