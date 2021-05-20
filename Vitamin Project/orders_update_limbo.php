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
	}
	
	else {
		echo "unlogged";
		header("location: index.php");
	}
	echo "<br>";
	//CPY -^-
	
	//updates all orders from POST
	print_r($_POST);
	
	require 'dbInteract.php';
	$ordernos=getOrdernos();
	
	while($row=$ordernos->fetch_assoc()) {
		$orderno=$row['ORDERNO'];
		$varname="s_status$orderno";
		
		$var="";
		if(isset($_POST["$varname"]))
			$var=$_POST["$varname"];
		else {
			echo "orderno $orderno was not in \$_POST";
			nl();
			continue;
		}
		$status=strtoupper($var);
		updateOrder($orderno,$status,"");
		nl();
	}
	
	echo "done.";
	nl();
	header("location: orders.php");
?> 






