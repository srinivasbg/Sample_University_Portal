<?php
session_start(); 
session_unregister($dpt);
session_unregister($sn1);
session_destroy(); 
header('location:checklogin.php'); // Back to login form 
?>