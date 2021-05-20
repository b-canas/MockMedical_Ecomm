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
		header("location: index.php");
		exit;
	}
	echo "<br>";
	//CPY -^-
	require 'dbInteract.php';
	
	//cart stuff v
	updateCart($_POST,$userid);
	
	echo "done";
	nl();
	
	$cart=getCart($userid);
	
	if($cart->num_rows==0) {
		echo "Nothing in cart!";
		nl();
		header("location: cart_view_empty.php");
		exit;
	}
	else {
		echo "Going to checkout!";
		nl();
		header("location: checkout.php");
		exit;
	}
?>





