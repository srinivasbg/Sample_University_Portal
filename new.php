<?php
session_start();
$IID=$_SESSION['IID'];
$host="localhost";
$user="root";
$password="";
$dbname="univ2";
$link=mysql_connect($host,$user,$password);
$query1="select distinct cno,secno,time,day,room,count(*) from section where IID='".$IID."'AND sem='f09' AND waitno=0 group by cno";//selects details for a particular instructor 
$query2="select distinct se.cno,se.secno,se.time,se.day,se.room,count(*) from section se,enrollment e where se.secno=e.secno AND se.sem='s10' AND e.waitno!=0 AND IID='".$IID."' group by cno";//selects students who are in waitlist for the upcoming spring 2010
$cuser1=mysql_db_query($dbname,$query2,$link)or die('Select error'.mysql_error());
$cuser=mysql_db_query($dbname,$query1,$link)or die('Select error'.mysql_error());
$no1=mysql_num_rows($cuser1);
$s1=0;
?>
<html>
<head><title>Details</title></head>
<body background="lightblue.jpg">
<p><h4>Number of students currently enrolled in this semester</p>
<table border="1" cellpadding="5" cellspacing="5" width="100%">
<tr><th class="style4" width="20%">Section No</th><th width="20%">Course No</th><th width="20%">Time</th><th width="20%">Day</th><th width="20%">Number of students</th><th width="20%">Room No</th></tr>

<?php while($r2=mysql_fetch_array($cuser))
{
?>
	<tr>
	<td><?php echo $r2['secno'];?></td>
	<td><?php echo $r2['cno'];?></td>
	<td><?php echo $r2['time'];?></td>
	<td><?php echo $r2['day'];?></td>
	<td><?php echo $r2['count(*)'];?></td>
	<td><?php echo $r2['room'];?></td>
	</tr>	
	<?php 
}
?>
</table>
<?php 
$no=mysql_num_rows($cuser);
$s=0;
?>
<p><h4>Number of students in waitlist for current semester</p>
<table border="1" cellpadding="5" cellspacing="5" width="100%">
<tr><th class="style4" width="20%">Section No</th><th width="20%">Course No</th><th width="20%">Time</th><th width="20%">Day</th><th width="20%">Number of students</th><th width="20%">Room No</th></tr>
<?php 
while($r1=mysql_fetch_array($cuser1))
{
?>
	<tr>
	<td><?php echo $r1['secno'];?></td>
	<td><?php echo $r1['cno'];?></td>
	<td><?php echo $r1['time'];?></td>
	<td><?php echo $r1['day'];?></td>
	<td><?php echo $r1['count(*)'];?></td>
	<td><?php echo $r1['room'];?></td>
	</tr>	
	<?php 
}
?>
</table>
			
			<form method="POST" action="old.php">
			<p>Click <input type="submit" value="Here">to know number of students enrolled in a course in previous semesters
			<input type="hidden" name="req1" value='"+id+"'> 
			</form>
			
			Click<a href="lout.php">Here</a>to log out <!-- Click to Log out -->
			</body>
			</html>