<?php
require ('dbConnection.php');
require ('user_DBaccess.php');

session_start();

//Get username and password variables from Login Form
$username = $_POST["username"];
$password = $_POST["password"];

//get_user_withLogin is a function from user_DBaccess.php
$user = get_user_withLogin($username, $password);

if ($user != NULL) {
    //A user with matching credentials was found
    //Save important user variables in the cookie
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user['USERID'];
    $_SESSION['access'] = $user['ACCESS'];

    if ($_SESSION['access'] == 0)
        header('location: vitimins_worker.php');
    else
        header('location: products.php');
}
else {
    //Login Failed
    header('location: index.php');
}
?>
