<?php
include 'dbConnection.php';

if (isset($_POST["registerButton"])) {
    $registrationUsername = $_POST["registrationUsername"];
    $registrationPassword = $_POST["registrationPassword"];
    $hashedPassword = password_hash($registrationPassword, PASSWORD_DEFAULT);
    $normalAccess = "-1";

    $selectUsernames = "SELECT * FROM users WHERE USERNAME='$registrationUsername';";
    $CheckUsernames = mysqli_query($conn,$selectUsernames);
    if (mysqli_num_rows($CheckUsernames) > 0) {
        echo "Username already exists! Failed to create account";
    }
    else {
        $query = "INSERT INTO users (USERNAME,PASSWORD,ACCESS) VALUES ('$registrationUsername','$hashedPassword','$normalAccess')";
        $run = mysqli_query($conn,$query);
    }
}
?>
