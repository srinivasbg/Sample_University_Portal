<?php
session_start();
$found=false;
$_POST['req']=44;
$_POST['pass']="abc12345";
if(isset($_POST['req'])&& isset($_POST['pass']))
{
	$found=false;
$host="localhost";
$user="root";
$password="";
$dbname="univ2";
$link=mysql_connect($host,$user,$password);
$query6="select IID,password from instructor where IID='".$_POST['req']."'AND password='".$_POST['pass']."'";
$cuser=mysql_db_query($dbname,$query6,$link)or die('Select error'.mysql_error());
$num=mysql_num_rows($cuser);
if($num>0)
{
$_SESSION['IID']=$_POST['req'];
$IID=$_SESSION['IID'];
$host="localhost";
$user="root";
$password="";
$dbname="univ2";
$link=mysql_connect($host,$user,$password);
$query1="select distinct cno,secno,time,day,room,count(*) from section where IID='".$IID."'AND sem='f09' AND waitno=0 group by cno";
$query2="select distinct se.cno,se.secno,se.time,se.day,se.room,count(*) from section se,enrollment e where se.secno=e.secno AND se.sem='s10' AND e.waitno!=0 AND IID='".$IID."' group by cno";
$cuser1=mysql_db_query($dbname,$query2,$link)or die('Select error'.mysql_error());
$no1=mysql_num_rows($cuser1);
$s1=0;
$sec1['sec1']=array();
$cno1['cno1']=array();
$time1['time1']=array();
$day1['day1']=array();
$count1['count1']=array();
$room1['room1']=array();
while($r2=mysql_fetch_array($cuser1))
{
	if($s1<$no1-1)
	{
	$sec1['sec1'][]=$r2['secno'];
	$cno1['cno1'][]=$r2['cno'];
	$time1['time1'][]=$r2['time'];
	$day1['day1'][]=$r2['day'];
	$count1['count1'][]=$r2['count(*)'];
	$room1['room1'][]=$r2['room'];
	$s=$s+1;
	}
	else
	{
		$sec1['sec1'][]=$r2['secno'];
		$cno1['cno1'][]=$r2['cno'];
		$time1['time1'][]=$r2['time'];
		$day1['day1'][]=$r2['day'];
		$count1['count1'][]=$r2['count(*)'];
		$room1['room1'][]=$r2['room'];
	}
}

$cuser5=mysql_db_query($dbname,$query1,$link)or die('Select error'.mysql_error());
$no=mysql_num_rows($cuser5);
$s=0;
$sec['sec']=array();
$cno['cno']=array();
$time['time']=array();
$day['day']=array();
$count['count']=array();
$room['room']=array();
while($r1=mysql_fetch_array($cuser5))
{
	if($s<$no-1)
	{
	$sec['sec'][]=$r1['secno'];
	$cno['cno'][]=$r1['cno'];
	$time['time'][]=$r1['time'];
	$day['day'][]=$r1['day'];
	$count['count'][]=$r1['count(*)'];
	$room['room'][]=$r1['room'];
	$s=$s+1;
	}
	else
	{
		$sec['sec'][]=$r1['secno'];
		$cno['cno'][]=$r1['cno'];
		$time['time'][]=$r1['time'];
		$day['day'][]=$r1['day'];
		$count['count'][]=$r1['count(*)'];
		$room['room'][]=$r1['room'];
		echo json_encode($sec).";".
		 json_encode($cno).";".
		json_encode($time).";".
		json_encode($day).";".
		 json_encode($count).";".
		 json_encode($room).";".
		 json_encode($sec1).";".
		json_encode($cno1).";".
		json_encode($time1).";".
		json_encode($day1).";".
		json_encode($count1).";".
		json_encode($room1);
		
	}		 
}

}
else
{
	echo "bad username or password";
}
}
?>
