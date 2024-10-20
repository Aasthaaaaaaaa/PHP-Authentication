<?php
 session_start();
 if(!isset($_SESSION["email"]))
 {
 	header("location:login.php");
 }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="logout.php"> Logout </a>
	THIS IS PAGE---1
	<a href="page-2.php"> GO TO PAGE--2 </a>
</body>
</html>
