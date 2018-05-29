<?php session_start();?>
<html>
<head></head>
<body background="lightblue.jpg">
<ul> 
<?php 
$IID=$_SESSION['IID'];
/* checks whether session variable for semester is set and also checks whether semester variable is posted from previous page old.php */
if(!isset($_SESSION['sem'])|| $_POST['sem']!="")
{
$_SESSION['sem']=$_POST['sem'];
$sem=$_SESSION['sem'];
}
else
{
	$sem=$_SESSION['sem'];
}
$host="localhost";
$user="root";
$password="";
$dbname="univ2";
$link=mysql_connect($host,$user,$password);
$query1="select cno,secno,count(*),sem from section where IID='".$IID."' AND sem='".$sem."' AND waitno=0 group by secno";//selects course number,section number and number of students  for the particular semester he/she has selected in old.php
$cuser1=mysql_db_query($dbname,$query1,$link)or die('Select error'.mysql_error());
$no1=mysql_num_rows($cuser1);
$i=0;
?>
<p>Details of courses took</p>
<table width="100%" cellpadding="5" border="1" cellspacing="5">
<tr>
<th>Course No</th>
<th>Section No</th>
<th>Number of Students</th>
</tr>
<?php 
while($r2=mysql_fetch_array($cuser1))
{
	
$query2="select count(*) from enrollment where secno in (select secno from section where secno='".$r2['secno']."' AND sem='".$sem."')";//gives number of students present for a particular section from the enrollment table
$cuser2=mysql_db_query($dbname,$query2,$link)or die('Select error'.mysql_error());
$r3=mysql_fetch_array($cuser2);
	?>
<tr>
<td><a href="getroster.php?cno=<?php echo $r2['cno']; ?>&sem=<?php echo $sem; ?>&secno=<?php echo $r2['secno']?>"><?php echo $r2['cno']; ?></a></td><!-- getroster.php gives the details for that class -->
<td><?php echo $r2['secno']; ?></td>
<td><?php echo $r3['count(*)']; ?></td>
</tr>
<?php }
?>
</table>
Click <a href="old.php">here </a>to view semesters
<br><br>

</body>
</html>