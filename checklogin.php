<?php
ob_start();
$host="localhost";  //parameters for database connection
$username="root";  
$password="";  
$db_name="univ2";  
$tbl_name="student"; 
mysql_connect("$host", "$username", "$password")or die("Database was not able to connect"); //mysql connect statement
mysql_select_db("$db_name")or die("The Database cannot be selected");

$myusername=$_POST['studentid']; 
$mypassword=$_POST['password'];
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE studentid='$myusername' and password='$mypassword'";//checking the student table for login
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
header("location:login_success.php");
}
else {
header ('Location: index.php?IncorrectLogin=true'); // send user back to the login page 
}
ob_end_flush();
?>