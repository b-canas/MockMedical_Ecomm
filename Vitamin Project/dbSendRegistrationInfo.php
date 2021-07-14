<?php
include 'dbConnection.php';

if (isset($_POST["registerButton"])) {
    $registrationUsername = $_POST["registrationUsername"];
    $registrationPassword = $_POST["registrationPassword"];

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];

    $hashedPassword = password_hash($registrationPassword, PASSWORD_DEFAULT);
    $normalAccess = "-1";

    $selectUsernames = "SELECT * FROM users WHERE USERNAME='$registrationUsername';";
    $CheckUsernames = mysqli_query($conn,$selectUsernames);
    if (mysqli_num_rows($CheckUsernames) > 0) {
        echo "Username already exists! Failed to create account";
    }
    else {
        $query = "INSERT INTO users (USERNAME,PASSWORD,ACCESS,FNAME,LNAME,ADDRESS,PHONE,EMAIL) VALUES ('$registrationUsername','$hashedPassword','$normalAccess','$first_name','$last_name','$address','$phone_number','$email')";
        $run = mysqli_query($conn,$query);
    }
}
?>
