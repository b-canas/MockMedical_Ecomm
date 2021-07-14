<?php
	$username=$_POST['username'];
	$password=$_POST['password'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$access=-1;
	echo "$username $password $access $fname $lname $address $phone $email<br>";
	if($username=="" || ($password=="") || ($fname=="") || ($lname=="") || ($address=="") || ($phone=="") || ($email=="")) {
		echo "<br>param's null";
		exit;
		//header("location: createAccount_failure.php");
	}
	
	include 'dbInteract.php';
	
	$inserted=insertUser($username,$password,$access,$fname,$lname,$address,$phone,$email);
	
	echo "<br>$inserted<br>";
	
	if($inserted) {
		echo "<br>inserted.";
		header("location: login.php");
	}
	else {
		echo "<br>failure.";
		//header("location: createAccount_failure.php");
	}
?>