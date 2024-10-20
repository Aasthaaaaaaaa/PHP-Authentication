<?php 
session_start();
if(!isset($_SESSION["email"]))
 {
 	header("Location:login.php");
 }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 THIS IS SAMPLE PAGE--2
 <a href="page-1.php"> GO TO PAGE--1 </a>
</body>
</html>
