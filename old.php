<?php session_start();?>
<html>
<head></head>
<body background="lightblue.jpg">
<ul> 
<?php 
/* Check whether session instructor id is set, if not then session variable is registered */ 
if(!isset($_SESSION['IID']))
{
$_SESSION['IID']=$_POST['req1'];
$IID=$_SESSION['IID'];
}
else
{
	$IID=$_SESSION['IID'];
}
$host="localhost";
$user="root";
$password="";
$dbname="univ2";
$link=mysql_connect($host,$user,$password);
$query1="select distinct sem from section where IID='".$_SESSION['IID']."'";//query selects semesters that the instructor has teached
$cuser1=mysql_db_query($dbname,$query1,$link)or die('Select error'.mysql_error());
$no1=mysql_num_rows($cuser1);
$i=0;
?>
<form action="getdata.php" method="POST">
<p>Check previous semesters number of students</p>
<select name="sem">
<?php 
while($r2=mysql_fetch_array($cuser1))
{ ?>
<option value=<?php echo $r2['sem']; ?>><?php echo $r2['sem']; ?> <!-- put semesters inside a drop down menu--> 
<?php } ?>
</select>
<br /><input type="submit" name="submit" value="Submit!"> 
</form>
Click<a href="new.php">Here</a>to view details of current semester <!-- Click to view details of the selected semester -->
Click<a href="lout.php">Here</a>to log out <!-- Click to Log out -->
</body>
</html>

