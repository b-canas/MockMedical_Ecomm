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
		echo "loggedin with $userid $username $password $access";
		header("location: orders.php");
	}
	else {
		echo "unlogged";
		header("location: index.html");
		exit;
	}
	echo "<br>";

	
	
?>