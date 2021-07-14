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
		echo "loggedin with $userid $username  $password $access";
	}
	else {
		echo "unlogged";
		header("location: index.html");
	}
	echo "<br>";
	
	if(isset($_POST['buy'])) {
		echo "buy proper";
		
	}
	else {
		echo "no buy!";
		header("location: index.html");
		exit;
	}
	
	
	
	require 'dbInteract.php';
	nl();
	$credentials="gibberish";
	$buySuccess=checkoutUser($userid,$credentials);
	
	if($buySuccess===TRUE) {
		echo "buy succ";
		$_SESSION['buy_success']=TRUE;
		header("location: buy_success.php");
		exit;
	}
	
?>
