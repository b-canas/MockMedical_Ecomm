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
	}
	else {
		echo "unlogged";
		//header("location: index.php");
		exit;
	}
	echo "<br>";
	//CPY -^-

	require 'dbInteract.php';
	//cart stuff v
	echo "\$_POST:";
	nl();
	print_r($_POST);
	nl();
	updateCart($_POST,$userid);
	
	echo "done";
	nl();
	
	if(isset($_POST['cart'])) {
		echo "cart";
		header("location: products_logged.php");
		exit;
	}
	else if(isset($_POST['buy'])) {
		echo "buy";
		header("location: checkout_limbo.php");
		exit;
	}
	
?>