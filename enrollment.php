<?php
session_start();
$chkid=$_SESSION['myusername'];
$sn1=$_SESSION['sname'];
$dpt=$_SESSION['deptname'];
$con = mysql_connect("localhost","root",""); 
if (isset($_POST['Submit4']))
{
	$_SESSION['val']=$_POST[drp];
	if (!empty($_POST[drp]))
	header("location:payment.php");
	else
		{
			echo "Please Make a Selection for Payment !!!!";
		}
	
}

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
?>
<?php 
if (isset($_POST['submit']))
	{
		$select=$_POST[select];
		$select2=$_POST[select2];
			if (!empty($select)) 
		    { 
  				 /* The following query will find if the selected course was already taken by the student */
		    	$query = "select en.secno,s.seccap,s.sem,s.waitcap,s.waitno,s.cno,s.day,s.time,s.room
						  from enrollment en,section s
						  where en.studentid=$chkid and en.secno=s.secno and (en.secno=$select or s.cno=$select2)";
				$res = mysql_query($query);	
  				if(!$res) die(mysql_error());
  				$num_rows = mysql_num_rows($res);
  				/*Checking if the student is enrolling for  two classes at same day/time.*/
  				$chk="select s.day,s.time from section s,enrollment en where s.secno='".$select."'";
  				$chk = mysql_query($chk);	
  				if(!$chk) die(mysql_error());
		   		 while($my=mysql_fetch_array($chk))
  						 { 
  						    	$day=$my['day'];	
  						    	$time=$my['time'];
  						    		
  						    		
  					     }
  					     
  				/**/
  			    $m1 = "select * from section s,enrollment e where s.day='".$day."' and s.time='".$time."' and s.secno=e.secno and e.studentid=$chkid";
				$m2 = mysql_query($m1);	
				$m3 = mysql_num_rows($m2);
				
				if($m3==0)
				{
								
				if($num_rows==0)
				{
				  	 /*The following query checks if the course that the student is trying to enroll has any prerequistes and if any exists it returns the grade 
				  	  * The prereq is found for the particular course and then joined with the section to fetch all the sections for that prereq and then joined 
				  	  * again with the enrollment to get the enrollment for that particlar sections he has chosen.Then we check the grade to see whether he has 
				  	  * completed the course or not.*/	
					$query2="select pr.prereqid, en.grade, pr.cno, sec.secno
							from prereq pr
							left outer join section sec
							on pr.prereqid = sec.cno
							left outer join
							enrollment en on sec.secno = en.secno
							where
							en.grade is  not null
							and
							pr.cno=$select2
							and
							en.studentid = $chkid";
				  		 $res2=mysql_query($query2);
				 		 if(!$res2) die(mysql_error());
  				 		 $num_rows2 = mysql_num_rows($res2);
				     if($num_rows2==0)
				  	{
				  	
  						
									
					 			  			/*Fetching the prereq for that course and displaying an error message if he is not fininshed */
				  							$sri="select prereqid from prereq where cno=$select2";
					 			  			$nn=mysql_query($sri);
				 						    if(!nn) die(mysql_error());
				 						    $ns2 = mysql_num_rows($nn);
				 						    if($ns2!=0)
				 						    {
				 						    while($n1=mysql_fetch_array($nn))
				 						    {									
  											?>
				  							<script type="text/javascript">
    										alert("Pre Requiste Course <?php echo "$n1[0]"?>   is required.");
   											 history.back();
 				 							</script>
 				 							
				  							<?php
				 						    }
				 						    }
				 						    else
				 						    {
				 						    /*Checking if the student enrolling is not exceeding the section and waitlist capacity. */	
				 						    $s1="select seccap,waitcap from section where secno=$select";
				  								$s2="select count(*) from enrollment where secno=$select";
				         						$r3=mysql_query($s1);
				         						if(!$r3) die(mysql_error());
				         						$r4=mysql_query($s2);
				        						if(!$r4) die(mysql_error());
				        						 while($r=mysql_fetch_array($r3))
  												 	{ 
  						 							 $cmp1=$r[0];
  						 	 						 $t1=$r[1];  						
  					   							 	 }
				  		 						while($r=mysql_fetch_array($r4))
  													 { 
  														$cmp2=$r[0];
  						 							 }
				  									if($cmp2<$cmp1)
				  									{	
														/*If the student enrolling is lesser than section capacity then allow hime to enroll */	
				  										$res3 = mysql_query("INSERT INTO `univ2`.`enrollment` (`secno`, `grade`, `studentid`, `rosterno`, `gradeunits`, `waitno`) VALUES ($select, 'In Progress', $chkid, '1', '0', '0')");
				 										 if(!$res3) die(mysql_error());
				  										 echo "<br>";
				  										 echo "<You are now enrolled for this course";
				  									}
				 									 else
				  									{
				   										/*If the student enrolling into the section is greater than section capacity then check the max waitlist number and if that is less then the waitlist capacity then insert into waitlist. */	
				  										$s3="select max(waitno) from enrollment where secno=$select";
				  											$r5=mysql_query($s3);
				  											if(!$r5) die(mysql_error());
				 											while($r=mysql_fetch_array($r5))
  															{ 
  															$cmp3=$r[0];
  															if($cmp3<$t1)
  															{
  																echo "$cmp3";
  																echo "$t1";
  																$res3 = mysql_query("INSERT INTO `univ2`.`enrollment` (`secno`, `grade`, `studentid`, `rosterno`, `gradeunits`, `waitno`) VALUES ($select, 'In Progress', $chkid, '1', '0', $cmp3+1)");
				  												if(!$res3) die(mysql_error());
				  												echo "<br>";
				  												echo "<You are now enrolled for this course";	
  															}
  															else
  															{
  																echo "The Course has reached its waitlist capacity";
  															}
  															}	
  					
				  									}
				 						    }
				 						    
				  			
				  	}
				  else
				  {
				  	
				  			while($r=mysql_fetch_array($res2))
  							{
  								
  								$sri="select prereqid from prereq where cno=$select2";
					 			  			$nn=mysql_query($sri);
				 						    if(!nn) die(mysql_error());
				 						    $ns2 = mysql_num_rows($nn);
				 						    if($ns2==0)
				 						    {
				 						    while($n1=mysql_fetch_array($nn))
				 						    {									
  											?>
				  							<script type="text/javascript">
    										alert("Pre Requiste Course <?php echo "$n1[0]"?>   is required.");
   											 history.back();
 				 							</script>
 				 							
				  							<?php
				 						    }
				 						    }
  								
  								else
  								{
									/*Checking if the grade of the prereq is completed or not */
						 			if ($r['grade']=="In Progress" )
  										{
  											?>
				  							<script type="text/javascript">
    										alert("Pre Requiste Course <?php echo "$r[0]"?>   is required.");
   											 history.back();
 				 							</script>
 				 	
				  							<?php
  										}
  									else
  										{
												/*If he has completed the prereq then check the waitlist and allow him to enroll*/
  												$s1="select seccap,waitcap from section where secno=$select";
				  								$s2="select count(*) from enrollment where secno=$select";
				         						$r3=mysql_query($s1);
				         						if(!$r3) die(mysql_error());
				         						$r4=mysql_query($s2);
				        						if(!$r4) die(mysql_error());
				        						 while($r=mysql_fetch_array($r3))
  												 	{ 
  						 							 $cmp1=$r[0];
  						 	 						 $t1=$r[1];  						
  					   							 	 }
				  		 						while($r=mysql_fetch_array($r4))
  													 { 
  														$cmp2=$r[0];
  						 							 }
				  									if($cmp2<$cmp1)
				  									{	
				 										 $res3 = mysql_query("INSERT INTO `univ2`.`enrollment` (`secno`, `grade`, `studentid`, `rosterno`, `gradeunits`, `waitno`) VALUES ($select, 'In Progress', $chkid, '1', '0', '0')");
				 										 if(!$res3) die(mysql_error());
				  										 echo "<br>";
				  										 echo "<You are now enrolled for this course";
				  									}
				 									 else
				  									{
				   											$s3="select max(waitno) from enrollment where secno=$select";
				  											$r5=mysql_query($s3);
				  											if(!$r5) die(mysql_error());
				 											while($r=mysql_fetch_array($r5))
  															{ 
  															$cmp3=$r[0];
  															if($cmp3<$t1)
  															{
  																echo "$cmp3";
  																echo "$t1";
  																/*If the wailist no is lesser than waitlist capacity then insert by 1 increment*/
  																$res3 = mysql_query("INSERT INTO `univ2`.`enrollment` (`secno`, `grade`, `studentid`, `rosterno`, `gradeunits`, `waitno`) VALUES ($select, 'In Progress', $chkid, '1', '0', $cmp3+1)");
				  												if(!$res3) die(mysql_error());
				  												echo "<br>";
				  												echo "<You are now enrolled for this course";	
  															}
  															else
  															{
  																echo "The Course has reached its waitlist capacity";
  															}
  															}	
  					
				  									}
				  						}
  								}
  							}//while close
  					  }		
  					}
  					
  					
				
		else
		{
		echo "You have either already completed the course or registered for the section";
		}
  		  
  				
		}
		else
		{
			echo "You cant enroll two classes at the same time";
		}
		
	}
		
	}
			
	
mysql_close($con);
?>
<?php 
$con = mysql_connect("localhost","root",""); 
if (!$con) 
{ 
die('Could not connect: ' . mysql_error()); 
}
mysql_select_db("univ2", $con);
if (isset($_POST['submit3']))
	{
		$dropsec=$_POST[drp];
		if (!empty($dropsec))
		{
			/* Drop the selection the user has made */
			
			mysql_query("DELETE from enrollment WHERE secno=$dropsec and studentid=$chkid");
		}
		else
		{
			echo "Please Make a Selection to drop!!!!";
		}
	}
?>

<script type="text/javascript">

function sel() {

	for(var i=0; i<document.forms['enroll'].elements.length; i++)
	{
	if (document.forms['enroll'].elements['select'][i].checked)
	{
	document.forms['enroll'].elements['select2'][i].checked = true;
	}
	}
}
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<title>Enrollment</title>

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
<div align="right"> <a  href="logout.php" >Sign Out</a></div>
<body style="background-image: url('website_background_1.jpg')">
<p class="style2"><strong>STUDENT UNIVERSITY PAGE </strong></p>
<p class="style3">Enrollment</p>
<p class="style1">&nbsp;</p>
<div align="center">
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
/*The Following query shows all the courses availiable for the particular student specialization for current and next semester */
mysql_select_db("univ2", $con);
$result1 = mysql_query("select  sp.sname,sec.cno,c.cname, sec.secno,sec.sem,c.catalog,sec.day,sec.time,sec.room
from
section sec left outer join specialization sp on
(sp.corecourses = sec.cno or
sp.electivecourses = sec.cno or
sp.corecourse2 = sec.cno or
sp.electivecourse2 = sec.cno
) left outer join courses c on sec.cno=c.cno left outer join enrollment en
on sec.secno = en.secno and en.studentid=$chkid where sp.stid=$chkid and (sec.sem='f09' or sec.sem='s10');
");
if(!$result1) die(mysql_error());
echo "<table border='1'>
<CAPTION><EM>Courses Availiable</EM></CAPTION>
<tr>
<th>Choose</th>
<th>Specialization</th>
<th>Course No.</th>
<th>Course Name</th>
<th>Section No.</th>
<th>Semester</th>
<th>Catalog Description</th>
<th>Day</th>
<th>Time</th>
<th>Room Allocated</th>
<th>Selected</th>
</tr>";
?>
<form name="enroll" method="post" action="<?php echo $PHP_SELF?>">
<?php 
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
  echo "<td> <input type='radio' name='select' value='$row[3]' onClick='sel()'/> </td>";  
  echo "<td>" . $row[0] . "</td>";
  echo "<td>" . $row[1] . "</td>";  
  echo "<td>" . $row[2] . "</td>";
  echo "<td>" . $row[3] . "</td>";
  echo "<td>" . $row[4] . "</td>";
  echo "<td>" . $row[5] . "</td>";
  echo "<td>" . $row[6] . "</td>";
  echo "<td>" . $row[7] . "</td>";
  echo "<td>" . $row[8] . "</td>";
  echo "<td> <input type='radio' name='select2' value='$row[1]'/> </td>";
  echo "</tr>";
  }
}  
echo "</table>";
mysql_close($con);

?>
<br></br>
<input name="submit" type="submit" value="Enroll">&nbsp;&nbsp;&nbsp;
<input name="Submit2" type="button" value="Go Back" onclick=" location.assign( 'login_success.php' );">
</form>
</div>
<div align="center">
<form name="drop" method="post" action="<?php echo $PHP_SELF?>">
<?php
echo "<br>";
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
/*The following query joins enrollment and section table to get the sections offered with the respective section information
 and then seeing what courses a student has not got a grade using his student id and is not in waitlist.The table is again joined with the course table to get the course name */

mysql_select_db("univ2", $con);
$result1 = mysql_query("SELECT s.cno,c.cname,s.secno,en.grade,en.gradeunits,s.sem
from
enrollment en left outer join section s on s.secno=en.secno
left outer join courses c on c.cno=s.cno
where en.grade = 'In Progress' and en.studentid=$chkid and en.waitno=0");
if(!$result1) die(mysql_error());
echo "<table border='1'>
<CAPTION><EM>Courses Enrolled</EM></CAPTION>
<tr>
<th>Selection</th>
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
  echo "<td> <input type='radio' name='drp' value='$row[2]'/> </td>";
  echo "<td>" . $row[0] . "</td>";
  echo "<td>" . $row[1] . "</td>";
  echo "<td>" . $row[2] . "</td>";
  echo "<td>" . $row[3] . "</td>";
  echo "<td>" . $row[4] . "</td>";
  echo "<td>" . $row[5] . "</td>";
  echo "</tr>";
  }
}  
echo "</table>";
echo "<br>";

mysql_close($con);
?>
<?php 


?>

<input name="submit3" type="submit" value="Drop">&nbsp;&nbsp;&nbsp;
<input name="Submit2" type="button" value="Go Back" onclick=" location.assign( 'login_success.php' );"> 
<input name="Submit4" type="submit" value="Make Payment" > 
</form>
</div>
<br>
</br>
<div align="center">
<form name="drop2" method="post" action="<?php echo $PHP_SELF?>">
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
/*The following query joins enrollment and section table to get the sections offered with the respective section information
 and then seeing what courses a student has not got a grade using his student id and is in waitlist.The table is again joined with the course table to get the course name */

mysql_select_db("univ2", $con);
$result1 = mysql_query("SELECT s.cno,c.cname,s.secno,en.grade,en.gradeunits,s.sem,en.waitno
from
enrollment en left outer join section s on s.secno=en.secno
left outer join courses c on c.cno=s.cno
where en.grade = 'In Progress' and en.studentid=$chkid and en.waitno!=0");
if(!$result1) die(mysql_error());
echo "<table border='1'>
<CAPTION><EM>Courses WaitListed</EM></CAPTION>
<tr>
<th>Selection</th>
<th>Course No.</th>
<th>Course Name</th>
<th>Section No.</th>
<th>Grade</th>
<th>GradeUnits Earned</th>
<th>Semester</th>
<th>WaitList Number</th>
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
  echo "<td> <input type='radio' name='drp' value='$row[2]'/> </td>";
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
<input name="submit3" type="submit" value="Drop">&nbsp;&nbsp;&nbsp;
<input name="Submit2" type="button" value="Go Back" onclick=" location.assign( 'login_success.php' );">
</form>
</div>

</body>

</html>
