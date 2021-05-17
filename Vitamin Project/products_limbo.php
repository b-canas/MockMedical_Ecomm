<?php
	//CPY -v-
	session_start();
	$username="";
	$userid="";
	$password="";
	$access="";
	
	$loggedin=false;
	if(isset($_SESSION['username'])) {
		$loggedin=true;
		$username=$_SESSION['username'];
		$userid=$_SESSION['userid'];
		$password=$_SESSION['password'];
		$access=$_SESSION['access'];
		
		echo "loggedin";
		echo header("location: products_logged.php");
	}
	else {
		echo "unlogged";
		echo header("location: products_unlogged.php");
	}
	echo "<br>";
	//CPY -^-
	
	
?> 