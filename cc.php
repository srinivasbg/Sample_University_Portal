<?php
session_start();
$chkid=$_SESSION['myusername'];
$sn1=$_SESSION['sname'];
$dpt=$_SESSION['deptname'];
if (isset($_POST['submit1']))
	{
		foreach($_POST[select] as $selection)
		{
			$_SESSION['selection'] = $selection;
			header('location:editcard.php');
		}
	}

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


echo "<br> </br>";

echo "Please make a selection";
if (isset($_POST['submit']))
	{
	$select=$_POST[select];
	 if (!empty($select)) 
		{ 
  				foreach($_POST[select] as $selection)
  				{
  				$query = "Delete from credit where ccno='$selection'"; //deleting a selected credit card
  				$result = mysql_query($query);	
			    if(!$result) die(mysql_error());
  				}
		}	
	}	
				
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>User Credit Card Details</title>
<a href="logout.php">Sign Out</a>
<style type="text/css">
.style1 {
	text-align: center;
	margin-left: 200px;
}
.style2 {
	text-align: center;
	font-size: x-large;
	margin-left: 200px;
}
.style3 {
	text-align: center;
	font-size: large;
	margin-left: 200px;
}
</style>
</head>

<body style="background-image: url('website_background_1.jpg')">

<p class="style2"><strong>STUDENT UNIVERSITY PAGE </strong></p>
<p class="style3"><strong>Credit Card Details</strong></p>
<p class="style1">&nbsp;</p>
<div align="center">
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("univ2", $con);

$result = mysql_query("SELECT * FROM credit where studentid=$chkid"); //Retrieving all the cards nos that the user has provided.

echo "<table border='1'>
<tr>
<th>SELECTION</th>
<th>STUDENT ID</th>
<th>NAME</th>
<th>ADDRESS</th>
<th>CREDIT CARD NO.</th>
</tr>";
?>
<form method="post" action="<?php echo $PHP_SELF?>">
<?php 
while($row = mysql_fetch_array($result))
  {
  	echo "<tr>";
  	echo "<td> <input type='checkbox' name='select[]' value='$row[3]'/> </td>";
  	echo "<td>" . $row['studentid'] . "</td>";
  	echo "<td>" . $row['name'] . "</td>";
   	echo "<td>" . $row['address'] . "</td>";
   	echo "<td>" . $row['ccno'] . "</td>";
  	echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?> 
<br>
</br>

<input name="submit1" type="submit" value="Edit" >&nbsp;&nbsp;&nbsp;
<input name="submit" type="submit" value="Delete">&nbsp;&nbsp;&nbsp;
<input name="Submit3" type="button" value="Insert" onclick=" location.assign( 'insertcard.php' );">
&nbsp;&nbsp;
<input name="Submit4" type="button" value="Go Back" onclick=" location.assign( 'account.php' );" style="width: 69px">
</form>
</div>
	

</body>

</html>
