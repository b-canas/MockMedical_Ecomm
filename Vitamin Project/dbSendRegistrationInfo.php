<?php
include 'dbConnection.php';
	
if (isset($_POST["registerButton"])) {
	$registrationUsername = $_POST["registrationUsername"];
	$registrationPassword = $_POST["registrationPassword"];
    $normalAccess = "1";

	$query = "INSERT INTO users (USERNAME,PASSWORD,ACCESS) VALUES ('$registrationUsername','$registrationPassword','$normalAccess')";
	$run = mysqli_query($conn,$query);
}
?>
