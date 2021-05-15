<?php
//include 'dbConnection.php'

//if (isset($_POST["loginButton"])) {
	//$username = $_POST["username"];
	//$password = $_POST["password"];
    
    //$query = "SELECT * from users WHERE username = '$username' AND password ='$password'"
    //$row = mysqli_fetch_array($query);

    //if ($row['username'] == $username && $row['password'] == $password) {
        //echo "Login success"
    //}
    //else {
        //echo "Login failed."
    //}
?>

<?php
include 'dbConnection.php';

$username = $_POST["username"];
$password = $_POST["password"];

    
$query = "SELECT * from users WHERE USERNAME = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row['USERNAME'] == $username && $row['PASSWORD'] == password_verify($password, $row['PASSWORD'])) {
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are logged in";
    header('location: navigation.html');
}
else {
    //echo "Login failed.";
    header('location: index.php');
}
?>