<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "se2_medicine";

//create connection
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName); 

//check for connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }
   //echo "Connected to database successfully";
?>
